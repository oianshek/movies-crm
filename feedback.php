<?php include_once 'database/link.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'headData.php' ?>
    <title>MovieLand | Feedback</title>
</head>

<body>

<?php
include_once('headerAndSearch.php');
?>

<section class="feedback-section">
    <h2 class="h1-responsive font-weight-bold text-center my-4">Give your feedback</h2>
    <div>
        <div class="mx-auto col-xl-6 col-lg-8 col-md-8 col-sm-8 col-12">
            <form class="feedback-form" id="contact-form" name="contact-form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="name" name="name" class="form-control">
                            <label for="name" class="">Your name</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="email" id="email" name="email" class="form-control">
                            <label for="email" class="">Your email</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form">
                            <textarea type="text" id="message" name="message" rows="2"
                                      class="form-control md-textarea"></textarea>
                            <label for="message">Your message</label>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button id="send" class="btn text-light">Send</button>
                </div>

            </form>
        </div>

    </div>

</section>
<?php
include_once('footer.php');
include_once('scripts.php');
?>

<script>
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        } else {
            return true;
        }
    }

    $('#send').on('click', function () {
        let name = $('#name').val();
        let email = $('#email').val();
        let message = $('#message').val();
        event.preventDefault();
        if (name == '' || email == '' || message == '') {
            let msg = "";
            if (name == '') {
                msg += "Name is empty!\n";
            }
            if (email == '') {
                msg += "Email is empty!\n";
            }
            if (message == '') {
                msg += "Message is empty!\n";
            }
            msg += "Please, fill it and try again.";
            alert(msg);
        }
        else if (!isEmail(email)) {
            alert("Email is invalid! Try again.");
        } else {
            $.ajax({
                url: 'addfeedback.php',
                type: 'POST',
                data: {
                    name: name,
                    email: email,
                    message: message
                },
                dataType: "html",
                success: function (data) {
                    alert(data);
                    window.location.href = "index.php";
                }
            });
        }
    });

</script>
</body>
</html>