<script type="text/javascript" src="/resources/circle/js/jQueryRotate.2.2.js"></script>
<style>
    #lottery {
        background: url("/resources/circle/images/disc-bg.png?v=79804") no-repeat scroll 0 0 transparent;
        /*background-size: 450px 450px;*/
        height: 450px;
        width: 100%;
       /* position: absolute;*/
        margin: 0 auto;
    }

    #lottery .arrow {
        background: url("/resources/circle/images/arrow.png?v=1bde2") no-repeat scroll 0 0 transparent;
        height: 191px;
        left: 206px;
        position: absolute;
        top: 120px;
        width: 32px;
        margin: 0 auto;

    }

    #lottery .lot-btn {
        height: 191px;
        left: 178px;
        overflow: hidden;
        position: absolute;
        top: 94px;
        width: 91px;
    }

    #lottery .lot-btn span {
        cursor: pointer;
        display: block;
        height: 191px;
        position: relative;
        width: 91px;
        margin: 0 auto;
    }

    #lottery .first span {
        background: url("/resources/circle/images/buttons_01.png?v=8bc8e") no-repeat scroll 0 0 transparent;
    }



    .demo{width:417px; height:417px; position:relative; margin:50px auto}
    #disk{width:417px; height:417px; background:url(disk.jpg) no-repeat}
    #start{width:163px; height:320px; position:absolute; top:46px; left:130px;}
    #start img{cursor:pointer}
</style>




    <div id="lottery">

        <img id="imgs" src="/resources/circle/images/disc-rotate.png" viewbox="0 0 352 30"
             style="position: relative; left: 47px; top: 47px; width: 352px; height: 352px;" class="image"/>

        <div class="lot-btn first">
            <span></span>
        </div>

    </div>


<div class="demo">
    <div id="disk"></div>
    <div id="start"><img src="start.png" id="startbtn"></div>
</div>


<button onclick="recicle()" >重新抽奖</button>


<script type="text/javascript">
    $(function () {
        var j=0;
        $(".lot-btn").click(function () {

            for (var i = 0; i <= 10000; i++) {
                j=i;
                $("#imgs").rotate({
                    animateTo: j,
                    duration: 5000
                });
                if (j >= 4068) {

                    break;
                }

            }

        });

    });
    function recicle(){
        i  =0;

        $("#imgs").rotate(i);
    }



</script>