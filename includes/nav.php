<?php
/**
 * nav.php - Sidebar navigation for the dashboard page
 * Includes the user panel and all menu links
 */
?>
<aside class="sidebar">
    <div class="sidebar-user">
        <div class="user-avatar"></div>
        <div class="user-name">Name</div>
    </div>

    <ul class="sidebar-menu">
        <li><span class="sidebar-section">Dashboard</span></li>
        <li><a href="dashboard.php" class="active">Home</a></li>

        <li><span class="sidebar-section">Inventory Management</span></li>
        <li><a href="#">All Items</a></li>
        <li><a href="#">Categories</a></li>

        <li><span class="sidebar-section">QR|Barcode Management</span></li>
        <li><a href="#">Items Barcode</a></li>

        <li><span class="sidebar-section">User Management</span></li>
        <li><a href="#">Staff Account</a></li>
        <li><a href="#">Supplier</a></li>

        <li><span class="sidebar-section">Transaction Logs</span></li>
        <li><a href="#">Checkout logs</a></li>
        <li><a href="#">Restock logs</a></li>

        <li><span class="sidebar-section">Report &amp; analytics</span></li>
        <li><a href="#">Stock Report</a></li>
        <li><a href="#">In-Demand Report</a></li>
        <li><a href="#">Expiration</a></li>

        <li><span class="sidebar-section">Settings</span></li>
        <li><a href="login.php" id="logoutBtn" class="logout-btn">Log out</a></li>
    </ul>
</aside>
