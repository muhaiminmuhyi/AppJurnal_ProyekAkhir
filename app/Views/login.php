<!DOCTYPE html>
<html>
 <head>
  <title>Gass Berkebun</title>
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<style>
    .form {
    margin: auto;
    width: 400px;
    padding: 20px 30px;
    background: #fff;
    border: 1px solid #dfdfdf;
    transform-style: preserve-3d;
    perspective-origin: 50px center;
    perspective: 2000px;
    transition: transform 1s ease;
    }
    .form::before, .form::after {
    content: "";
    position: absolute;
    width: 100%;
    left: 0;
    }
    .form::before {
    height: 100%;
    top: 0;
    transform: translateZ(-100px);
    background: #333;
    opacity: 0.3;
    }
    .form::after {
    content: "SUCCESS!";
    transform: translateY(-50%) translateZ(-101px) scaleX(-1);
    top: 50%;
    color: #fff;
    text-align: center;
    font-weight: bold;
    }

    .field {
    position: relative;
    background: #cfcfcf;
    transform-style: preserve-3d;
    }
    .field + .field {
    margin-top: 10px;
    }

    .icon {
    width: 24px;
    height: 24px;
    position: absolute;
    top: calc(50% - 12px);
    left: 12px;
    transform: translateZ(50px);
    transform-style: preserve-3d;
    }
    .icon::before, .icon::after {
    content: "";
    display: block;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    }
    .icon::after {
    transform: translateZ(-23px);
    opacity: 0.5;
    }

    .input {
    border: 1px solid #dfdfdf;
    background: #fff;
    height: 48px;
    line-height: 48px;
    padding: 0 10px 0 48px;
    width: 100%;
    transform: translateZ(26px);
    }

    .button {
    display: block;
    width: 100%;
    border: 0;
    text-align: center;
    font-weight: bold;
    color: #fff;
    background: linear-gradient(45deg, #e53935, #e35d5b);
    margin-top: 20px;
    padding: 14px;
    position: relative;
    transform-style: preserve-3d;
    transform: translateZ(26px);
    transition: transform 0.3s ease;
    cursor: pointer;
    }
    .button:hover {
    transform: translateZ(13px);
    }

    .side-top-bottom {
    width: 100%;
    }
    .side-top-bottom::before, .side-top-bottom::after {
    content: "";
    width: 100%;
    height: 26px;
    background: linear-gradient(45deg, #e2231e, #df4745);
    position: absolute;
    left: 0;
    }
    .side-top-bottom::before {
    transform-origin: center top;
    transform: translateZ(-26px) rotateX(90deg);
    top: 0;
    }
    .side-top-bottom::after {
    transform-origin: center bottom;
    transform: translateZ(-26px) rotateX(-90deg);
    bottom: 0;
    }

    .side-left-right {
    height: 100%;
    }
    .side-left-right::before, .side-left-right::after {
    content: "";
    height: 100%;
    width: 26px;
    position: absolute;
    top: 0;
    }
    .side-left-right::before {
    background: #e53935;
    transform-origin: left center;
    transform: rotateY(90deg);
    left: 0;
    }
    .side-left-right::after {
    background: #e35d5b;
    transform-origin: right center;
    transform: rotateY(-90deg);
    right: 0;
    }

    .email .icon::before, .email .icon::after {
    background: url(https://image.flaticon.com/icons/svg/131/131040.svg) center/contain no-repeat;
    }

    .password .icon::before, .password .icon::after {
    background: url(https://image.flaticon.com/icons/svg/130/130996.svg) center/contain no-repeat;
    }

    .face-up-left {
    transform: rotateY(-30deg) rotateX(30deg);
    }

    .face-up-right {
    transform: rotateY(30deg) rotateX(30deg);
    }

    .face-down-left {
    transform: rotateY(-30deg) rotateX(-30deg);
    }

    .face-down-right {
    transform: rotateY(30deg) rotateX(-30deg);
    }

    .form-complete {
    -webkit-animation: formComplete 2s ease;
            animation: formComplete 2s ease;
    }

    .form-error {
    -webkit-animation: formError 2s ease;
            animation: formError 2s ease;
    }

    input:active, input:focus, button:active, button:focus {
    outline: none;
    border: 1px solid #e77371;
    }

    @-webkit-keyframes formComplete {
    50%, 55% {
        transform: rotateX(30deg) rotateY(180deg);
    }
    100% {
        transform: rotateX(0deg) rotateY(1turn);
    }
    }

    @keyframes formComplete {
    50%, 55% {
        transform: rotateX(30deg) rotateY(180deg);
    }
    100% {
        transform: rotateX(0deg) rotateY(1turn);
    }
    }
    @-webkit-keyframes formError {
    0%, 100% {
        transform: rotateX(0deg) rotateY(0deg);
    }
    25% {
        transform: rotateX(-25deg);
    }
    33% {
        transform: rotateX(-25deg) rotateY(45deg);
    }
    66% {
        transform: rotateX(-25deg) rotateY(-30deg);
    }
    }
    @keyframes formError {
    0%, 100% {
        transform: rotateX(0deg) rotateY(0deg);
    }
    25% {
        transform: rotateX(-25deg);
    }
    33% {
        transform: rotateX(-25deg) rotateY(45deg);
    }
    66% {
        transform: rotateX(-25deg) rotateY(-30deg);
    }
    }
    small {
    color: #999;
    text-align: center;
    display: block;
    margin-top: 20px;
    -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
    }

    html, body {
    width: 100%;
    height: 100%;
    display: flex;
    background: linear-gradient(45deg, #83a4d4, #b6fbff);
    }

    *, *::before, *::after {
    box-sizing: border-box;
    }
</style>
 </head>
 <body>
 <div class="form" id="form">
    <center><h1>Gass Berkebun</h1></center>
    <form action="<?= base_url('login/ceklogin') ?>" method="post" id="form">
        <div class="field email">
            <div class="icon"></div>
            <input class="input" id="email" type="text" placeholder="Username" name="inputUsername" autocomplete="off"/>
        </div>
        <div class="field password">
            <div class="icon"></div>
            <input class="input" id="password" type="password" name="inputPassword" placeholder="Password"/>
        </div>
        <button class="button" id="submit">LOGIN
        <div class="side-top-bottom"></div>
        <div class="side-left-right"></div>
        <?php if (isset($pesan)) { ?>
            </button><small><?php echo $pesan; ?></small>
        <?php } ?>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script>

    var formAnim = {
        $form: $('#form'),
        animClasses: ['face-up-left', 'face-up-right', 'face-down-left', 'face-down-right', 'form-complete', 'form-error'],
        resetClasses: function() {
            var $form = this.$form;
            
            $.each(this.animClasses, function(k, c) {
                $form.removeClass(c);
            });
        },
        faceDirection: function(d) {
            this.resetClasses();
            
            d = parseInt(d) < this.animClasses.length? d : -1;
            
            if(d >= 0) {
                this.$form.addClass(this.animClasses[d]);
            } 
        }
    }

    var $input = $('#email, #password'),
            $submit = $('#submit'),
            focused = false,
            completed = false;


    $input.focus(function() {
        focused = true;
        
        if(completed) {
            formAnim.faceDirection(1);
        } else {
            formAnim.faceDirection(0);
        }
    });

    $input.blur(function() {
        formAnim.resetClasses();
    });

    $input.on('input paste keyup', function() {
        completed = true;
        
        $input.each(function() {
            if(this.value == '') {
                completed = false;
            }
        });
        
        if(completed) {
            formAnim.faceDirection(1);
        } else {
            formAnim.faceDirection(0);
        }
    });

    $submit.click(function() {
        focused = true;
        formAnim.resetClasses();
        
        if(completed) {
            $submit.css('pointer-events', 'none');
            setTimeout(function() {
                formAnim.faceDirection(4);
                $input.val('');
                completed = false;

                setTimeout(function() {
                    $submit.css('pointer-events', '');
                    formAnim.resetClasses();
                }, 2000);
            }, 1000);
        } else {
            setTimeout(function() {
                formAnim.faceDirection(5);

                setTimeout(function() {
                    formAnim.resetClasses();
                }, 2000);
            }, 1000);
        }
    });

    $(function() {
        setTimeout(function() {
            if(!focused) {
                $input.eq(0).focus();
            }
        }, 2000);
    })
</script>
 </body>
</html>