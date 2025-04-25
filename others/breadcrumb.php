<?php
// Get the current page URL
$current_page = basename($_SERVER['PHP_SELF']);
$path_info = pathinfo($current_page);
$current_page_name = ucfirst($path_info['filename']); // Capitalize first letter

// Define breadcrumb structure
$breadcrumbs = array();

// Add Home for all pages
$breadcrumbs[] = array('name' => 'Home', 'url' => base_url . 'index.php', 'active' => false);

// Add specific breadcrumbs based on current page
switch($current_page) {
    case 'courses.php':
        $breadcrumbs[] = array('name' => 'Courses', 'url' => '', 'active' => true);
        break;
    case 'cart.php':
        $breadcrumbs[] = array('name' => 'Cart', 'url' => '', 'active' => true);
        break;
    case 'myaccount.php':
        $breadcrumbs[] = array('name' => 'My Account', 'url' => '', 'active' => true);
        break;
    case 'signin.php':
        $breadcrumbs[] = array('name' => 'Sign In', 'url' => '', 'active' => true);
        break;
    case 'index.php':
        // Only show Home for index
        break;
    default:
        $breadcrumbs[] = array('name' => $current_page_name, 'url' => '', 'active' => true);
}
?>

<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <?php foreach($breadcrumbs as $index => $breadcrumb): ?>
                <?php if($breadcrumb['active']): ?>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $breadcrumb['name']; ?></li>
                <?php else: ?>
                    <li class="breadcrumb-item"><a href="<?php echo $breadcrumb['url']; ?>" class="text-decoration-none"><?php echo $breadcrumb['name']; ?></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ol>
    </nav>
</div> 