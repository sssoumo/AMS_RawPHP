    <div class="well">
        <h4>Website: www.rfsoftlab.com
            <span class="pull-right">Like us: www.facebook.com/rfsoftlab</span>
        </h4>
    </div>
    <script src="app/view/vendor/js/jquery.min.js"></script>
    <script src="app/view/vendor/js/bootstrap.min.js"></script>

    <?php if(isset(Document::$js) && !empty(Document::$js)) foreach (Document::$js as $key => $file) echo '<script src="'.$file.'"></script>'."\r\n";?>

    <!-- Custom JS goes here -->

</body>
</html>