    </div>
    <!-- End Main Panel -->

    <!-- BEGIN :: RIGHT PANEL -->
    <div class="rightpanel">

    </div>
    <!-- End Right Panel -->

    <footer>
        <div class="pull-right">Version: 1.0</div>
        <strong>Copyright © 2014-2017 <a href="http://rfsoftlab.com" target="_blank">RFsoftLab</a></strong>. All rights reserved.
    </footer>

    <script src="app/view/vendor/js/jquery-1.12.1.min.js"></script>
    <script src="app/view/vendor/js/bootstrap.min.js"></script>
    <script src="app/view/vendor/js/toggles.min.js"></script>

    <!-- Auto Expanding Text Area -->
    <script src="app/view/vendor/js/jquery.autogrow.js"></script>

    <script src="app/view/vendor/js/collapse.js"></script>

    <!-- Page specific Javascript-->
    <?php if(isset(Document::$js) && !empty(Document::$js)) foreach (Document::$js as $key => $file) echo '<script src="'.$file.'"></script>'."\r\n";?>

    <!-- Custom JS goes here -->
    <script src="app/view/vendor/js/custom.js"></script>
</body>
</html>