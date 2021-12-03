<style>
	li {
 display: block;
 transition-duration: 0.5s;
}

li:hover {
  cursor: pointer;
}

ul li ul {
  visibility: hidden;
  opacity: 0;
  position: absolute;
  transition: all 0.5s ease;
  margin-top: 1rem;
  left: 0;
  display: none;
}

ul li:hover > ul,
ul li ul:hover {

  visibility: visible;
  opacity: 1;
  display: block;
}

ul li ul li {
  clear: both;
  width: 100%;
}
</style>
<nav class="woocommerce-MyAccount-navigation">
	<ul>
		<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard is-active">
			<a href="./account.php">Dashboard</a>
		</li>
		
<!--<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders">
<a href="./orders/">Orders</a>
</li>
<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--downloads">
<a href="./downloads/">Downloads</a>
</li>


<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--payment-methods">
<a href="./payment-methods/">Payment methods</a>
</li>
<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account">
<a href="./edit-account/">Account details</a>
</li>-->
<?php if($session_role == 'admin'){ ?>
	<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
		<a href="./admin_glasses_view.php">Glasses</a>
	</li>
	<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
		<a href="./admin_coupons.php">Coupons</a>
	</li>
	<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-address">
    <a href="./admin_users.php">Users</a>
    </li>
    <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-address">
    <a href="./admin_cms.php">CMS</a>
    </li>


<?php }?>

<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
	<a href="./admin_orders.php">Orders</a>
</li>
<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--prescriptions">
<a href="./admin_prescriptions.php">Glasses Prescriptions</a>
</li>
<?php 
	if ($session_role == 'user') {
		?>

<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--prescriptions">
<a href="./customer_favourite.php">Favourites</a>
<?php 
	}

?>
</li>
<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-address dropdown">
<!-- <a href="./account_settings.php"></a> -->
<a href="#">Account Settings</a>
      <ul class="dropdown">
	  <li><a href="./personal_info.php" >Personal Info</a></li>
    <li><a href="./change_password.php">Password Change</a></li>
    <li><a href="./address_management.php">Address Management</a></li>
      </ul>
  
    </li>
<!--<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-address">-->
<!--<a href="./admin_addresses.php">Addresses</a>-->
<!--</li>-->

	
<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
	<a href="./?logout=1">Logout</a>
</li>
</ul>
</nav>