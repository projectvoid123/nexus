<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script src="https://unpkg.com/in-view@0.6.1/dist/in-view.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto+Mono:300,500');
        
        html, body {
            width: 100%;
            height: 100%;
        }
        
        body {
            margin: 0;
            background-color: #000;
            background-size: cover;
            background-repeat: no-repeat;
            min-height: 100vh;
            min-width: 100vw;
            font-family: "Roboto Mono", "Liberation Mono", Consolas, monospace;
            color: rgba(255,255,255,.87);
        }
        
        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }
        
        .container,
        .container > .row,
        .container > .row > div {
            height: 100%;
        }
        
        #countUp {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        
        #countUp .number {
            font-size: 4rem;
            font-weight: 500;
        }
        
        #countUp .number + .text {
            margin: 0 0 1rem;
        }
        
        #countUp .text {
            font-weight: 500;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="top-line"></div>
    <div class="container">
        <div class="row">
            <div class="xs-12 md-6 mx-auto">
                <div id="countUp">
                    <div class="number" data-count="404">0</div>
                    <div class="text">Page not found</div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Start the animation immediately when page loads
        $(document).ready(function() {
            var $number = $('.number');
            var countTo = $number.attr('data-count');

            $({ countNum: 0 }).animate({
                countNum: countTo
            },
            {
                duration: 2500,
                easing: 'linear',
                step: function() {
                    $number.text(Math.floor(this.countNum));
                },
                complete: function() {
                    $number.text(this.countNum);
                }
            });
        });
    </script>
</body>
</html>
