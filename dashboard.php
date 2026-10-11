<?php
/**
 * dashboard.php - Inventory Dashboard page
 * Uses PHP include for modular code organization
 * Originally converted from dashboard.html
 */

include_once __DIR__ . '/includes/config.php';

$pageTitle = "CafeTrack - Inventory Dashboard";
include __DIR__ . '/includes/header.php';
?>

<div class="dashboard">
    <?php include __DIR__ . '/includes/nav.php'; ?>

    <main class="dashboard-main">
        <header class="dashboard-header">
            <h1 class="dashboard-title">Inventory Dashboard</h1>
        </header>

        <div class="stats-row">
            <div class="stat-card">
                <span class="stat-label">Total Items</span>
                <span class="stat-value">225</span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Low Stocks</span>
                <span class="stat-value">12</span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Out of Stock</span>
                <span class="stat-value">12</span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Expired items</span>
                <span class="stat-value">7</span>
            </div>
        </div>

        <div class="dashboard-content">
            <div class="dashboard-grid">
                <div class="hero-section">
                    <h2 class="hero-title">CafeTrack</h2>
                    <img class="hero-illustration" src="Coffee-shop-bro.svg" alt="Coffee Shop">
                </div>

                <div class="card">
                    <h3 class="card-title">In-Demand Items</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Current Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Condense</td><td>15</td></tr>
                            <tr><td>Caramel Sauce</td><td>4</td></tr>
                            <tr><td>Noodles</td><td>10</td></tr>
                            <tr><td>Milk</td><td>7</td></tr>
                        </tbody>
                    </table>
                    <button class="card-btn">view</button>
                </div>

                <div class="card">
                    <h3 class="card-title">Stock</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Milk</td><td>72</td></tr>
                            <tr><td>Coffee beans</td><td>15</td></tr>
                            <tr><td>Vanilla Syrup</td><td>12</td></tr>
                            <tr><td>Creamer Sack</td><td>5</td></tr>
                        </tbody>
                    </table>
                    <button class="card-btn">Manage Stock</button>
                </div>

                <div class="card">
                    <h3 class="card-title">Expiring Soon</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Days left</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Nata</td><td>2 Days</td></tr>
                            <tr><td>Ube Powder</td><td>4 Days</td></tr>
                            <tr><td>Almond Syrup</td><td>4 Days</td></tr>
                            <tr><td>Nutella</td><td>6 Days</td></tr>
                        </tbody>
                    </table>
                    <button class="card-btn">view</button>
                </div>

                <div class="card">
                    <h3 class="card-title">Recent Activity</h3>
                    <table>
                        <thead>
                            <tr>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td><b>Restocked</b></td><td>- Milk x12 | 15 min ago</td></tr>
                            <tr><td><b>Check Out</b></td><td>- Condense x15 | 40 min ago</td></tr>
                            <tr><td><b>low Stock</b></td><td>- White Sauce | 1hr ago</td></tr>
                            <tr><td><b>Expired</b></td><td>- Strawberry syrup x2 | 1hr ago</td></tr>
                            <tr><td><b>Expired</b></td><td>- fruit jelly | 2hr ago</td></tr>
                        </tbody>
                    </table>
                    <button class="card-btn">view</button>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
