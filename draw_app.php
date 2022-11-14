<?php
require_once "header_draw.php";
?>
<div id="main" class="container">
    <script src="sketch.js"></script>
    <div id="sketchCanvas" class="p-4 container">
    </div>
    <div class="container p-2">
        <button onclick="clearButton()" class="btn">Clear Canvas</button>
        <button onclick="saveButton()" class="btn">Save Image</button>
    </div>
</div>
</body>
</html>