<script type="text/javascript" src="/resources/circle/js/jQueryRotate.2.2.js"></script>
<script type="text/javascript" src="/resources/jquery-ui/effect/jquery.easing.min.js"></script>
<style>
    #lottery {
        background: url("/resources/circle/images/box.png?v=79804") no-repeat scroll 0 0 transparent;
        background-size: 272px 272px;
        height: 272px;
        width: 272px;
        margin: 0 auto;
    }
    .image{
        cursor : pointer;
        position: relative;
        left: 91px;
        top: 40px;
        width: 90px;
        height: 191px;
    }
    body{
        background-color: #ff822e;
    }
    .panel {
        position: relative;
        margin: 15px 15px  5px 15px;
        padding: 0px 19px 14px 19px;
        *padding-top: 0px;
        background-color: #FFD993;
        border: 1px solid #ddd;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
    }
</style>

<header>
    <div id="lottery">

        <img id="imgs" src="/resources/circle/images/c-arrow.png" viewbox="0 0 90 191"
             class="image"/>


    </div>
</header>
<div class="container-fluid">
   <div class="row-fluid">
      <div class="panel">

        <span class="label label-important">
           奖项说明
        </span>

          <dl class="dl-horizontal">
              <dt>
                           一等奖
              </dt>
              <dd>A description list is perfect for defining terms.</dd>
              <dt>

                        二等奖
              </dt>
              <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
              <dt>
                     三等奖
              </dt>
              <dd>Malesuada porta</dd>

            </dl>


      </div>


   </div>


    <div class="row-fluid">
        <div class="panel">

        <span class="label label-success">
                   抽奖说明
         </span>

            <dl class="dl-horizontal">

                <dd>A description list is perfect for defining terms.</dd>

                <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>

                <dd>Malesuada porta</dd>

            </dl>


        </div>


    </div>

</div>


<script type="text/javascript">

    var pubweixin   = '<?=$pubweixin?>';
    var lottery     = '<?=$lotteryid?>';
    var member      = '<?=$member?>';
    var lcode       = '<?=$lotterycode?>';
    var mcode       = '<?=$merchantcode?>';

    $(function () {
        var a =<?=$angle?>; //角度
        var p ='<?=$prize?>'; //奖项名
        var g = '<?=$id?>';//等级

        $("#imgs").click(function () {
            $("#imgs").rotate({
                duration:6000, //转动时间
                angle: 0,
                animateTo:3600+a, //转动角度
                easing: $.easing.easeOutSine,
                callback: function(){
                   $.get('/lotterydial/winit/'+lottery+'/'+member+'/'+g+'/'+lcode,function(again){

                         window.location.href=window.location.href;

                    });


                }
            });
        });

    });


</script>
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">系统提示</h3>
    </div>
    <div class="modal-body">
        <p>继续努力!</p>
    </div>
    <div class="modal-footer">
        <button class="btn btn-block btn-danger "ata-dismiss="modal" aria-hidden="true">再来一次</button>
    </div>
</div>