<?php
include_once("header.php");
include_once("admin_authentication.php");
?>

<div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-2 align-center">
            <h1>About Page Details</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <?php
        // Start Generation Here
        $query = "SELECT * FROM about_us";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                echo "<p>" . $row['content'] . "</p>";
            }
        } else {
            echo "<p>No content available.</p>";
        }

        ?>
    </div>
</div>
<div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-2 align-center">
            <h1>Change Content</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>CKEditor 5 with Text Color and Background Color</title>
            <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/decoupled-document/ckeditor.js"></script>
            <style>
                #editor-content {
                    width: 100%;
                    height: 200px;
                }
            </style>
        </head>

        <body>
            <form action="admin_manage_about.php" method="post">
                <!-- Toolbar container -->
                <div id="toolbar-container"></div>

                <!-- Editor container -->
                <div id="editor">
                    <?php
                    $query = "SELECT * FROM about_us";
                    $result = mysqli_query($con, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                            echo $row['content'];
                        }
                    } else {
                        echo "<p>No content available.</p>";
                    }

                    ?>
                </div>

                <!-- Hidden textarea to store the HTML content -->
                <textarea id="editor-content" name="editor_content" style="display:inline"></textarea>
                <br>
                <input type="submit" value="Update Content" class="btn btn-dark" name="updt_about">
                <script>
                    DecoupledEditor.create(document.querySelector("#editor"), {
                            toolbar: [
                                "heading",
                                "bold",
                                "italic",
                                "link",
                                "bulletedList",
                                "numberedList",
                                "blockQuote",
                                "fontColor",
                                "fontBackgroundColor",
                                "undo",
                                "redo",
                            ],
                            heading: {
                                options: [{
                                        model: "paragraph",
                                        title: "Paragraph",
                                        class: "ck-heading_paragraph",
                                    },
                                    {
                                        model: "heading1",
                                        view: "h1",
                                        title: "Heading 1",
                                        class: "ck-heading_heading1",
                                    },
                                    {
                                        model: "heading2",
                                        view: "h2",
                                        title: "Heading 2",
                                        class: "ck-heading_heading2",
                                    },
                                    {
                                        model: "heading3",
                                        view: "h3",
                                        title: "Heading 3",
                                        class: "ck-heading_heading3",
                                    },
                                    {
                                        model: "heading4",
                                        view: "h4",
                                        title: "Heading 4",
                                        class: "ck-heading_heading4",
                                    },
                                    {
                                        model: "heading5",
                                        view: "h5",
                                        title: "Heading 5",
                                        class: "ck-heading_heading5",
                                    },
                                    {
                                        model: "heading6",
                                        view: "h6",
                                        title: "Heading 6",
                                        class: "ck-heading_heading6",
                                    },
                                ],
                            },
                            fontColor: {
                                colors: [{
                                        color: "hsl(0, 0%, 0%)",
                                        label: "Black",
                                    },
                                    {
                                        color: "hsl(0, 75%, 60%)",
                                        label: "Red",
                                    },
                                    {
                                        color: "hsl(30, 75%, 60%)",
                                        label: "Orange",
                                    },
                                    {
                                        color: "hsl(60, 75%, 60%)",
                                        label: "Yellow",
                                    },
                                    {
                                        color: "hsl(120, 75%, 60%)",
                                        label: "Green",
                                    },
                                    {
                                        color: "hsl(180, 75%, 60%)",
                                        label: "Cyan",
                                    },
                                    {
                                        color: "hsl(240, 75%, 60%)",
                                        label: "Blue",
                                    },
                                    {
                                        color: "hsl(300, 75%, 60%)",
                                        label: "Magenta",
                                    },
                                ],
                            },
                            fontBackgroundColor: {
                                colors: [{
                                        color: "hsl(0, 0%, 100%)",
                                        label: "White",
                                    },
                                    {
                                        color: "hsl(0, 75%, 60%)",
                                        label: "Red",
                                    },
                                    {
                                        color: "hsl(30, 75%, 60%)",
                                        label: "Orange",
                                    },
                                    {
                                        color: "hsl(60, 75%, 60%)",
                                        label: "Yellow",
                                    },
                                    {
                                        color: "hsl(120, 75%, 60%)",
                                        label: "Green",
                                    },
                                    {
                                        color: "hsl(180, 75%, 60%)",
                                        label: "Cyan",
                                    },
                                    {
                                        color: "hsl(240, 75%, 60%)",
                                        label: "Blue",
                                    },
                                    {
                                        color: "hsl(300, 75%, 60%)",
                                        label: "Magenta",
                                    },
                                ],
                            },
                        })
                        .then((editor) => {
                            const toolbarContainer = document.querySelector("#toolbar-container");
                            toolbarContainer.appendChild(editor.ui.view.toolbar.element);

                            // Get the HTML content from the editor and update the textarea
                            document.querySelector("#editor-content").value = editor.getData();

                            editor.model.document.on("change:data", () => {
                                document.querySelector("#editor-content").value = editor.getData();
                            });
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                </script>
            </form>
        </body>

        </html>

    </div>
</div>
</div>
<?php
include_once('admin_footer.php');
if (isset($_POST['updt_about'])) {
    $about_content = $_POST['editor_content'];
    $q1 = "select * from about_us";
    $res1 = mysqli_query($con, $q1);
    $count = mysqli_num_rows($res1);
    if ($count == 0) {
        $q2 = "INSERT INTO about_us (content) VALUES ('$about_content')";
        if (mysqli_query($con, $q2)) {
            setcookie("success", 'Page Content Updated', time() + 5, "/");
        } else {
            setcookie("error", 'Failed to update page content', time() + 5, "/");
        }
    } else {
        $q = "UPDATE about_us SET content='$about_content'";
        if (mysqli_query($con, $q)) {
            setcookie("success", 'Page content updated', time() + 5, "/");
        } else {
            setcookie("error", 'Failed to update page content', time() + 5, "/");
        }
    }
?>
    <script>
        window.location.href = "admin_manage_about.php";
    </script>
<?php
}
?>