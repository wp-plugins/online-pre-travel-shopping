<div class="sf_demo_page">
    <h2>Shopnfly Searchboxes &rsaquo; Demo Page</h2>
    <p>To add one of the boxes anywhere to your blog just copy the shortcode below the box and paste it to your theme template files.</p>
    <p>If you want to have a specific box inside one of your posts or one of your static pages, just go to the editing interface and insert the box via the Shopnfly Button on your visual editor.</p>
    <div class="sf_demo_search_box">
        <h3>Rectangle Searchbox:</h3>
        <?php include(SF_TRAVELSHOPPING_ABSPATH . 'views/admin/demo/rectangle.php'); ?>
        <p>Shortcode : <input type="text" size="100" value='[sf_travel_shop t = "rectangle"]' onclick="this.select();"></p>
    </div>
    <div class="sf_demo_search_box">
        <h3>Wide Searchbox:</h3>
        <?php include(SF_TRAVELSHOPPING_ABSPATH . 'views/admin/demo/wide.php'); ?>
        <p>Shortcode : <input type="text" size="100" value='[sf_travel_shop t = "wide"]' onclick="this.select();"></p>
    </div>
    <div class="sf_demo_search_box" style="width: 400px;">
        <h3>Narrow Searchbox:</h3>
        <?php include(SF_TRAVELSHOPPING_ABSPATH . 'views/admin/demo/narrow.php'); ?>
        <p>Shortcode : <input type="text" size="100" value='[sf_travel_shop t = "narrow"]' onclick="this.select();"></p>
    </div>
    <div class="sf_demo_search_box" style="width: 700px;">
        <h3>Dynamic Width Searchbox:</h3>
        <?php include(SF_TRAVELSHOPPING_ABSPATH . 'views/admin/demo/dynamic.php'); ?>
        <p>Shortcode : <input type="text" size="100" value='[sf_travel_shop t = "dynamic-width"]' onclick="this.select();"></p>
    </div>
</div>