<?

define( "_CATEGORY_SCRIPT", "products.php" );
define( "_PRODUCT_SCRIPT", "products.php" );

class Output
{
	function Output()
	{
		print "";
	}
	
	function listItems($a)
	{
		$list = "<ul>";
		
		foreach( $a as $item )
		{
			$list .= "<li>" . $item . "</li>";
		}
		
		return $list . "</ul>";
	}
	
	function getCategoryTrail( $categoryId )
	{
		global $qcDb;

		$qcDb->query( qcSql( "SELECT categoryId, name, parentCategoryId FROM #__categories WHERE categoryId = " . $categoryId ) );
		$qcDb->nextRow();
		$a = array();
		$a[$qcDb->row['categoryId']] = $qcDb->row['name'];
		
		while( $qcDb->row['parentCategoryId'] != 0 )
		{
			$qcDb->query( qcSql( "SELECT categoryId, name, parentCategoryId FROM #__categories WHERE categoryId = " . $qcDb->row['parentCategoryId'] ) );
			$qcDb->nextRow();
			$a[$qcDb->row['categoryId']] = $qcDb->row['name'];
		}
		
		return array_reverse($a, true);
	}
	
	function getCategoryMenu( $parent = 0 )
	{
		$list = $this->getCategoryList($parent);
		$a = array();
		
		foreach ( $list as $id => $item )
		{
			$a[] = "<a href='" . _CATEGORY_SCRIPT . "?categoryId=" . $id . "'>" . $item . "</a>";
			
			if ( isset( $_GET['categoryId'] ) )
			{
				$trail = $this->getCategoryTrail($_GET['categoryId']);
			
				if ( !empty( $trail[$id] ) )
				{
					$innerList = $this->getCategoryMenu($id);
					
					if ( count( $innerList ) > 0 ) 
						$a[] = $this->listItems( $innerList );
				}
			}
		}
		
		return $a;
	}
	
	function getAllCategoryList($parent = 0, $levels = "", $levelText = "%s", $level = 1 )
	{
		global $qcDb;
		
		$qcDbInner = clone $qcDb;
		
		$qcDbInner->query( qcSql( "SELECT categoryId, name FROM #__categories WHERE parentCategoryId = " . $parent ) );
		$a = array();
		
		while( $qcDbInner->nextRow() )
		{
			$a[$qcDbInner->row['categoryId']] = sprintf( $levelText, $qcDbInner->row['name'] );
			
			if ( empty( $levels ) || $levels > $level )
				$a += $this->getAllCategoryList($qcDbInner->row['categoryId'], $levels, sprintf( $levelText, $levelText ), $level + 1 );
		}		
		
		return $a;
	}
	
	function getCategoryList( $parent = 0 )
	{
		global $qcDb;
		
		$qcDb->query( qcSql( "SELECT categoryId, name FROM #__categories WHERE parentCategoryId = " . $parent ) );
		$a = array();
		
		while( $qcDb->nextRow() )
		{
			$a[$qcDb->row['categoryId']] = $qcDb->row['name'];
		}		
		
		return $a;
	}
	
	function getCategoryListing( $parent = 0, $imageType = "small" )
	{
		global $qcDb, $qcConfig_installPath, $qcConfig_imgProduct, $imageSizes;
		
		$qcDb->query( qcSql( "SELECT c.*, p.mainImageId FROM #__categories as c LEFT JOIN #__products as p ON c.featureProductId = p.productId WHERE c.parentCategoryId = " . $parent ) );
		$a = array();
		
		while( $qcDb->nextRow() )
		{
			ob_start();
			
			$link = _CATEGORY_SCRIPT . "?categoryId=" . $qcDb->row['categoryId'];
		?>
			<div style='width: <?= $imageSizes[$imageType]['w'] ?>px; height: <?= $imageSizes[$imageType]['h'] ?>px;'><a href='<?= $link ?>'><?= ( !empty( $qcDb->row['featureProductId'] ) ? "<img src='" . $qcConfig_installPath . "/" . $qcConfig_imgProduct . "/" . $qcDb->row['featureProductId'] . "/" . $qcDb->row['mainImageId'] . "." . $imageType . ".jpg' alt='".$qcDb->row['name']."' />" : " " ) ?></a></div>
			<div class='category'>
			<a href='<?= $link ?>'><?= $qcDb->row['name'] ?></a>
			</div>
		<?
			$a[] = ob_get_clean();
		}		
		
		return $a;
	}
	
	function getProductListing( $parent = 0, $imageType = "small" )
	{
		global $qcDb, $qcConfig_installPath, $qcConfig_imgProduct, $imageSizes;
		
		$qcDb->query( qcSql( "SELECT p.* FROM #__products as p, #__productInCategories as pc WHERE p.productId = pc.productId AND pc.categoryId = " . $parent ) );
		$a = array();
		
		while( $qcDb->nextRow() )
		{
			ob_start();
			
			$link = _PRODUCT_SCRIPT . "?categoryId=" . $parent . "&amp;productId=" . $qcDb->row['productId'];
		?>
			<div style='width: <?= $imageSizes[$imageType]['w'] ?>px; height: <?= $imageSizes[$imageType]['h'] ?>px;'><a href='<?= $link ?>'><?= ( !empty( $qcDb->row['productId'] ) ? "<img src='" . $qcConfig_installPath . "/" . $qcConfig_imgProduct . "/" . $qcDb->row['productId'] . "/" . $qcDb->row['mainImageId'] . "." . $imageType . ".jpg' alt='".$qcDb->row['name']."' />" : " " ) ?></a></div>
			<div class='product'>
			<div><a href='<?= $link ?>'><?= $qcDb->row['name'] ?></a></div>
			<div class='price'>Price: <?= qcMoney( $qcDb->row['price'] ) ?></div>
			</div>
		<?
			$a[] = ob_get_clean();
		}		
		
		return $a;
	}


	function getCategoryTitle( $categoryId )
	{
		global $qcDb;
		return $qcDb->result( qcSql( "SELECT name FROM #__categories WHERE categoryId = " . $categoryId ) );
	}

	function getCategoryHeader( $categoryId )
	{
		global $qcDb, $qcConfig_installPath, $qcConfig_imgCategory;
		$qcDb->query( qcSql( "SELECT name, description FROM #__categories WHERE categoryId = " . $categoryId ) );
		$qcDb->nextRow();
		
		$imageType = "small";
		ob_start();

		if ( file_exists ( $qcConfig_installPath . "/" . $qcConfig_imgCategory . "/" . $categoryId . "." . $imageType . ".jpg" ) )
		{
		?>
			<div style='float: right; padding: 0px 0px 15px 15px;'><img src='<?= $qcConfig_installPath . "/" . $qcConfig_imgCategory . "/" . $categoryId . "." . $imageType . ".jpg" ?>' alt='<?= $qcDb->row['name']?>' /></div>
		<?
		}
	?>
		<h1><?= $qcDb->row['name'] ?></h1>
		<div><?= $qcDb->row['description'] ?></div>
		<div style='clear: both;'></div>
	<? 
		return ob_get_clean();
	}
	

	function getProductInfo( $productId )
	{
		global $qcDb, $qcConfig_installPath, $qcConfig_imgProduct, $imageSizes;
		
		$qcDb->query( qcSql( "SELECT name, description, price, mainImageId FROM #__products WHERE productId = " . $productId ) );
		$qcDb->nextRow();
		
		$imageType = "med";
		$thumbImageType = "mini";
		$fullImageType = "full";
		
		ob_start();
	?>
		<h1><?= $qcDb->row['name'] ?></h1>
	<?
		if ( file_exists ( $qcConfig_installPath . "/" . $qcConfig_imgProduct . "/" . $productId . "/" . $qcDb->row['mainImageId'] . "." . $imageType . ".jpg" ) )
		{
		?>
			<div style='float: left; padding: 0px 10px 10px 0px;'>
			<div style='text-align: center; width: <?= $imageSizes[$imageType]['w'] + 20 ?>px;'>
				<div><a href='<?= $qcConfig_installPath . "/" . $qcConfig_imgProduct . "/" . $productId . "/" . $qcDb->row['mainImageId'] . "." . $fullImageType . ".jpg" ?>' onclick='return false;' rel='lightbox[product]' title='<?= $qcDb->row['name'] ?>'><img src='<?= $qcConfig_installPath . "/" . $qcConfig_imgProduct . "/" . $productId . "/" . $qcDb->row['mainImageId'] . "." . $imageType . ".jpg" ?>' alt='<?= $qcDb->row['name'] ?>' /></a></div>
			<?
				$qcDbInner = clone $qcDb;
				$qcDbInner->query( qcSql( "SELECT imageId, productId FROM #__productImages WHERE productId = " . $productId . " AND imageId <> " . $qcDb->row['mainImageId'] ) ); 
				
				if ( $qcDbInner->numRows > 0 )
				{
				?>
					<div style='margin: 10px 0px; text-align: left;'>
					<strong>Additional Images:</strong>
				<?
					while( $qcDbInner->nextRow() )
					{
					?>
						<div style='float: left; margin: 10px 5px 0px 0px; text-align: center;'>
							<div style='width: <?= $imageSizes[$thumbImageType]['w'] ?>px; height: <?= $imageSizes[$thumbImageType]['h'] ?>px;'><a href='<?= $qcConfig_installPath . "/" . $qcConfig_imgProduct . "/" . $productId . "/" . $qcDbInner->row['imageId'] . "." . $fullImageType . ".jpg" ?>' onclick='return false;' rel='lightbox[product]' title='<?= $qcDb->row['name'] ?>'><img src='<?= $qcConfig_installPath . "/" . $qcConfig_imgProduct . "/" . $productId . "/" . $qcDbInner->row['imageId'] . "." . $thumbImageType . ".jpg" ?>' alt='<?= $qcDb->row['name'] ?>' /></a></div>
						</div>
					<?
					}
				?>
					</div>
				<?
				}
			?>
			</div>
			</div>
		<?
		}
	?>
		<div style='float: left; width: <?= 690 - $imageSizes[$imageType]['w'] - 20 - 10 ?>px;'>
			<div>Price: <strong><?= qcMoney( $qcDb->row['price'] ); ?></strong></div>
			<br />
			<div><?= $qcDb->row['description'] ?></div>
			<br />
			<div>
			<?
				print $this->getProductVariantForm( $productId );
			?>
			</div>
		<?
			
		?>
			
		</div>
		<div style='clear: both;'></div>
	<? 
		return ob_get_clean();
	}
	
	function getProductVariantForm( $productId )
	{
		$list = $this->getProductVariantList( $productId );
						
		$form = new Form("cart.php");
		
		foreach( $list as $key => $variant )
		{
			switch( $variant['type'] )
			{
				case "Text":
					$form->add( new FormInputText( $variant['name'], "variants[" . $key . "]" ) ); 
					break;
					
				case "Select List":
				default:
					$form->add( new FormSelect( $variant['name'], "variants[" . $key . "]", $variant['variants'] ) ); 
					break;
			}
		}
		
		$form->add( new FormSelect("Quantity", "quantity", arrayNumberRange(1,99,1) ) );
		$form->add( new FormInputHidden("productId", $productId ) );
		$form->add( new FormInputSubmit("", "", "Add to Cart" ) );
		
		return $form->toHTML();
	}
	
	function getProductVariantList( $productId = 0 )
	{
		global $qcDb;
		
		$qcDbInner = clone $qcDb;
		
		$qcDbInner->query( qcSql( "SELECT v.*, vt.name as variantTypeName FROM #__variantInProducts as vp, #__variants as v, #__variantTypes as vt WHERE vp.variantId = v.variantId AND v.variantTypeId = vt.variantTypeId AND vp.productId = " . $productId ) );
		$a = array();
		
		while( $qcDbInner->nextRow() )
		{
			$a[$qcDbInner->row['variantId']] = array(
				"name" => $qcDbInner->row['name'],
				"type" => $qcDbInner->row['variantTypeName'],
				"variants" => $this->getVariantOptionList($qcDbInner->row['variantId']),
			);
		}		
		
		return $a;
	}
	
	function getVariantOptionList( $variantId = 0 )
	{
		global $qcDb;
		
		$qcDbInner = clone $qcDb;
		
		$qcDbInner->query( qcSql( "SELECT vo.* FROM #__variantOptions as vo WHERE vo.variantId = " . $variantId . " ORDER BY rank" ) );
		$a = array();
		
		while( $qcDbInner->nextRow() )
		{
			$a[$qcDbInner->row['variantOptionId']] = $qcDbInner->row['name'] . ( !empty( $qcDbInner->row['price'] ) ? " (" . qcMoney( $qcDbInner->row['price'] ) . ")" : "" );
		}		
		
		return $a;
	}
	
	
	function addToCart($a)
	{
		global $qcSession;
		
		if ( !empty( $_POST['recalculate'] ) || !empty( $_POST['checkout'] ) )
			$this->updateCart();
		else
			$_SESSION['cart']['items'][] = $a;
		
		$this->combineCart();
	}
	
	function updateCart()
	{
		if ( is_array( $_POST['quantity'] ) )
			foreach( $_POST['quantity'] as $key => $qty )
				$_SESSION['cart']['items'][$key]['quantity'] = $qty;
		
		if ( is_array( $_POST['remove'] ) )
			foreach( $_POST['remove'] as $key => $productId )
				unset( $_SESSION['cart']['items'][$key] );
	}
	
	function combineCart()
	{
		global $qcSession;
		
		foreach( $_SESSION['cart']['items'] as $key => $item )
		{
			if ( empty( $_SESSION['cart']['items'][$key] ) )
			{
				unset( $_SESSION['cart']['items'][$key] );
				continue;
			}

			foreach( $_SESSION['cart']['items'] as $searchKey => $searchItem )
			{
				if ( $key == $searchKey )
					continue;
				else if ( empty( $_SESSION['cart']['items'][$searchKey] ) )
					continue;
					
				$quantity = $_SESSION['cart']['items'][$key]['quantity'];
				$searchQuantity = $_SESSION['cart']['items'][$searchKey]['quantity'];
				
				unset( $_SESSION['cart']['items'][$key]['quantity'] );
				unset( $_SESSION['cart']['items'][$searchKey]['quantity'] );
									
				if ( $_SESSION['cart']['items'][$key] == $_SESSION['cart']['items'][$searchKey] )
				{
					$_SESSION['cart']['items'][$key]['quantity'] += $quantity + $searchQuantity;
					unset( $_SESSION['cart']['items'][$searchKey] );
					break;
				}
				else
				{
					$_SESSION['cart']['items'][$key]['quantity'] = $quantity;
					$_SESSION['cart']['items'][$searchKey]['quantity'] = $searchQuantity;
				}
			}
		}
	}
	
	function cart()
	{
		global $qcDb, $qcConfig_installPath, $qcConfig_imgProduct;
		
		if ( empty( $_SESSION['cart']['items'] ) )
		{
			$_SESSION['cart']['subtotal'] = 0;
			$_SESSION['cart']['total'] = 0;
		?>
			<em>There are no products in your shopping cart</em>
		<?
			return;
		}
		
	?>
		<form id='basketForm' method='post'>
		<div id='basketList'>
		<table cellspacing='0' cellpadding='0' border='0' style='width: 100%;'>
		<tr>
			<td class='rowHead'></td>
			<td class='rowHead' style='text-align: left;'>item</td>
			<!--<td class='rowHead'>price</td>-->
			<td class='rowHead'>quantity</td>
			<td class='rowHead'>total</td>
			<td class='rowHead'>remove</td>
		</tr>
		<?
			$i = 0;
			$subtotal = 0;
						
			foreach( $_SESSION['cart']['items'] as $key => $item )
			{
				$class = "row" . ( $i % 2 == 0 ? "Even" : "Odd" );

				$qcDb->query( qcSql( "SELECT name, description, price, productId, thumbImageId, mainImageId FROM #__products WHERE productId = " . $item['productId'] ) );
				$qcDb->nextRow();
				$unitPrice = $qcDb->row['price'];
				
				$qty = new FormSelect("Quantity", "quantity[" . $key . "]", arrayNumberRange(1,99,1), $item['quantity'] );
				
				$thumbPath = $qcConfig_installPath . "/" . $qcConfig_imgProduct . "/" . $qcDb->row['productId'] . "/" . $qcDb->row['thumbImageId'] . ".icon.jpg";
			?>
				<tr>
					<td class='<?= $class ?>'><?= ( $qcDb->row['thumbImageId'] != 0 && file_exists( $thumbPath ) ? "<img src='" . $thumbPath . "' />" : "no" ) ?></td>
					<td class='<?= $class ?>' style='width: 100%;'>
					<div class='product'><?= $qcDb->row['name'] ?></div>
					<?
						if ( is_array( $item['variants'] ) )
						{
						?>
							<div class='variants'>
						<?
							foreach( $item['variants'] as $variantId => $variantOptionId )
							{
								$qcDb->query( qcSql( "SELECT v.*, vt.name as variantTypeName FROM #__variants as v, #__variantTypes as vt WHERE v.variantTypeId = vt.variantTypeId AND v.variantId = " . $variantId ) );
								$qcDb->nextRow();
							?>
								<div class='variant'>
									<span claass='variantName'><?= $qcDb->row['name'] ?>: </span>
									<span claass='variantValue'><?
									if ( $qcDb->row['variantTypeName'] == "Text" )
										print $variantOptionId;
									else
									{	
										$qcDb->query( qcSql( "SELECT vo.* FROM #__variantOptions as vo WHERE vo.variantOptionId = " . $variantOptionId ) );
										$qcDb->nextRow();
										print $qcDb->row['name'] . ( !empty( $qcDb->row['price'] ) ? " (" . qcMoney($qcDb->row['price']) . ")" : "" );
										$unitPrice += $qcDb->row['price'];
									}
									?></span>
								</div>
							<?
							}
						?>
							</div>		
						<?
						}
					?>		
					</td>
					<!--<td class='<?= $class ?>' style='text-align: right;'><?= qcMoney( $unitPrice )?></td>-->
					<td class='<?= $class ?>' style='text-align: center;'><?= $qty->toHTML() ?></td>
					<td class='<?= $class ?>' style='text-align: right;'><?= qcMoney( $unitPrice * $item['quantity'] )?></td>
					<td class='<?= $class ?>' style='text-align: center;'><input type='checkbox' name='remove[<?= $key ?>]' value='<?= $item['productId'] ?>' /></td>
				</tr>
			<?
				$total += $unitPrice * $item['quantity'];
				$i++;
			}
		?>
		</table>
		</div>
		
		<table cellspacing='0' cellpadding='0' border='0' style='width: 100%;'>
		<tr>
			<td class='rowShippingDetails' style='width: 100%;'>shipping <em>(based on shipping address provided)</em></td>
			<td class='rowTotal'>total</td>
			<td class='rowPrice'><nobr><?= qcMoney( $total ) ?></nobr></td>
		</tr>
		<tr>
			<td colspan='3' class='rowButton'><a href='#' onclick='$("basketForm").recalculate.value = 1; $("basketForm").submit(); return false;'>recalculate</a></td>
		</tr>
		<tr>
			<td colspan='3' class='rowButton'><a href='#' onclick='$("basketForm").checkout.value = 1; $("basketForm").submit(); return false;'>proceed</a></td>
		</tr>
		</table>
		<input type='hidden' name='checkout' value='' />
		<input type='hidden' name='recalculate' value='' />
		</form>
	<?
		$_SESSION['cart']['subtotal'] = $total;
	}
	
	function cartPlain()
	{
		global $qcDb;
		
		ob_start();
		
		if ( empty( $_SESSION['cart']['items'] ) )
		{
			$_SESSION['cart']['subtotal'] = 0;
			$_SESSION['cart']['total'] = 0;
		
?>There are no products in your shopping cart

<?
			return ob_get_clean();
		}
		
		$i = 1;
					
		foreach( $_SESSION['cart']['items'] as $key => $item )
		{
			$qcDb->query( qcSql( "SELECT name, description, price, mainImageId FROM #__products WHERE productId = " . $item['productId'] ) );
			$qcDb->nextRow();
			$unitPrice = $qcDb->row['price'];
			
?><?= $i ?>. <?= $qcDb->row['name'] ?>

<?
	if ( is_array( $item['variants'] ) )
	{
		foreach( $item['variants'] as $variantId => $variantOptionId )
		{
			$qcDb->query( qcSql( "SELECT v.*, vt.name as variantTypeName FROM #__variants as v, #__variantTypes as vt WHERE v.variantTypeId = vt.variantTypeId AND v.variantId = " . $variantId ) );
			$qcDb->nextRow();

?>       <?= $qcDb->row['name'] ?>: <?
			if ( $qcDb->row['variantTypeName'] == "Text" )
				print $variantOptionId;
			else
			{	
				$qcDb->query( qcSql( "SELECT vo.* FROM #__variantOptions as vo WHERE vo.variantOptionId = " . $variantOptionId ) );
				$qcDb->nextRow();
				print $qcDb->row['name'] . ( !empty( $qcDb->row['price'] ) ? " (" . qcMoney($qcDb->row['price']) . ")" : "" );
				$unitPrice += $qcDb->row['price'];
			}
?>

<?
		}
	}
?>
Unit Price: <?= qcMoney( $unitPrice )?>

Quantity: <?= $item['quantity'] ?>

Price: <?= qcMoney( $unitPrice * $item['quantity'] ) ?>


<?
			$i++;
		}
		
		return ob_get_clean();
	}
	
	function checkout()
	{
		global $qcOutput, $qcDb, $qcConfig_path, $qcConfig_installPath, $qcConfig_GST, $qcConfig_PST, $qcConfig_BaseState, $qcConfig_BaseCountry, $qcConfig_BaseCurrency, $qcConfig_title, $qcConfig_domain;
		include $qcConfig_path . "/" . $qcConfig_installPath . "/" . "checkout.php";
	}
	
	function includeJS()
	{
		global $qcConfig_site, $qcConfig_installPath, $qcSession;
		
		ob_start();
		
		$site = $qcConfig_site;
		
		if ( $qcSession->secured )
			$site = str_replace( "http:", "https:", $site );
	?>
		<link rel="stylesheet" type="text/css" href="<?= $site . "/" . $qcConfig_installPath ?>/lightbox/css/lightbox.css" />
		
		<script src="<?= $site . "/" . $qcConfig_installPath ?>/lightbox/prototype.js" type="text/javascript"></script>
		<script src="<?= $site . "/" . $qcConfig_installPath ?>/lightbox/scriptaculous.js?load=effects" type="text/javascript"></script>
		<script src="<?= $site . "/" . $qcConfig_installPath ?>/lightbox/lightbox.js" type="text/javascript"></script>
		<script src="<?= $site . "/" . $qcConfig_installPath ?>/js/formValidator.js" type="text/javascript"></script>
	<?
		return ob_get_clean();
	}

}
		