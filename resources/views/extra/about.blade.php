@extends('layouts.app')
@section('content')
<title>{{__('ar.About')}}</title>
<div class="arti">
    <div class="arti-title">
        <h2>شو هاد هيلباك ؟؟</h2>
    </div>
    <div class="arti-body">
        <p>
        
            هاد الموقع الهدف الرئيسي منو انو خلي العالم تساعد بعضها قد ما بيقدرو لانو نحنا هلق بمرحلة اذا ما نحنا درنا بالنا عبعض ماحدا 
        حيدير بالو علينا .
        المهم شغلة هاد الموقع بسيطة و سهلة بتفوت عندك خدمة بدك تقدما لهل العالم بتكتبا و بتنشرا ,حابب تطلب خدمة من هل عالم كمان بتكتبها و بتنزلها,

    و العالم الي بتقدر تساعدك بتبعلك طلبات و العالم الي ممكن تستفيد من خدمتك كمان بتبعتلك طلبات و انتة بتقرر مين بدك تساعد ,

        و الشغلة التانية الي فيك تعملها هون هية انك اذا عندك شي غرض و حابب تبادلو مع شي حدا عغرض تاني فيك 
        , يعني بالمشرمحي تداكشو مداكشة بتكتوب شو غرضك و عشو بدك تبدلو و اذا بتحب بتنزل صور عن الغرض و العالم الي عندا بتبعتلك طلبات و ممكن تبعتلك صور عن الغراض الي عندا 
        .هلق لقدام في لسا شغلتين هيك ظراف مناح عاملون بالموقع بس ما خرج نفتحون هلق لانو لسا مافي هل عدد الكافي من المستخدمين لذلك اد مافيكون حاولو توصلو لاكبر عدد ممكن من الناس خلي الكل يستفاد,

        انا كتير حابب فيد هل بلد و هل عالم و الي انا منضمنون و حاليا هاد الشي الي طالع بايدي اعملو,

        اخيرا حبايبنا انتو حبو بعض خلينا نساعد بعض .
            
        </p> 
    </div>
    <div class="arti-footer">
        {{-- <p style="text-align:right !important;">
            هون شغلة حابب ضيفا انو الموقع ماحدا داعمو بشي ولا تابع لشركة ,
            فيلي حابب يدعم الموقع و يساعد و يساهم باي شكل بنكون شاكرين الك كتير ,
            فيك تحاكينا عن طريق الموقع بالروابط تحت او فيك تبعتلنا أيميلات و بنرجع بنحاكيك و بس .  
        </p><br> --}}
        <small> Made with <strong style="color:red">&hearts;</strong> for Syrians By Syrian </small><br>
        <small >helpak &copy; Syrians (السوريين)</small>
    </div>
    @auth
        <div id="Msg" class=" hidCont animated slideInDown" style="display: none">
            <div style="float: right;margin-right: 6%;">
                <i class="fa fa-times" onclick="document.querySelector('#msg').style.display='none'"></i>
                <i class="fa fa-check ml-2" onclick="sendMsg(event)"></i>
            </div>
            <input type="text" name="" id="msgContent" class="msgArea" placeholder="رسالتك او مقترحك هون" onkeypress="sendMsg(event)">
        </div>
        <div class="arti-links">
            <ul>
                {{-- <li class="bl"><a href="mailto:name@mail.com?body=Line1-text%0D%0ALine2-text"> ايميل</a></li> --}}
                <li class="bl"><a href="mailto:info@helpak.bixa.in?subject=بنتمنا ما يكون في اي مشكلة 
                    &body=كتوب هون الشي الي بدك يا"> 
                    ايميل</a></li>
                <li><a onclick="document.querySelector('#msg').style.display='block'"> رسالة</a></li>            
            </ul>        
        </div>
    @else 
        <div class="arti-links">
            <small>لازم تكون معنا بالموقع حتى تقدر تعمل الشغلات الي حكيناها فوق</small><br>
            <ul>
                <li class="bl"><a href="{{ route('login') }}">{{__('ar.login')}}</a></li>
                <li>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">{{__('ar.register')}}</a>
                    @endif
                </li>            
            </ul>        
        </div>
    @endif
    <div id="toast" class="animated fadeIn" style="display: none ;position: absolute;top: 95%;right: 2%;max-width: 30%;">
        <span class="alert alert-success" >وصلت , رسالتك صارت عنا شكرا الك</span>
    </div>
    <div id="toast2" class="animated fadeIn" style="display: none ;position: absolute;top: 95%;right: 2%;max-width: 30%;">
        <span class="alert alert-danger" >بنعتذر منك في مشكلة صارت رسالتك ما وصلنا ...</span>
    </div>
</div>
@endsection

<style>
    .arti{

    }
    .arti-title{
        text-align: right;
        font-size: 35px;
        font-family: inherit;
        max-height: 5%;
        border-bottom: 1px solid #d2cdcd; 
    }

    .arti-body{
        text-align: right;
        font-size: 18px;
        max-height: 40%;
        border-bottom: 1px solid #d2cdcd; 
    }

    .arti-footer{
        /* text-transform: full-width; */
        font-size: 16px;
        /* line-height: 3; */
        text-align: center;
        max-height: 10%;
        border-bottom: 1px solid #d2cdcd; 
    }

    .arti-links{
        font-size: 14px;
        font-weight: 800;
        text-transform: uppercase;
        text-align: center;
        height: 10%;
        margin-top: 10px
    }

    .arti-links ul{
        list-style: none;
        display: ruby-base-container;
    }

    .arti-links ul li{
        padding: 2px 10px ;
        border-right: 1px solid #888;
    }
    .bl{
        border-left: 1px solid #888;
    }
    .hidCont{
        display: none;
        max-height: 10% ;
        max-width: 100%;
        margin-top: 10px !important;
        text-align: center;
    }
    .msgArea{
        text-align: center;
        width: 90%;
        margin: 0px 5%;
        border: 2px solid #777;
        border-radius: 15px;
        box-shadow: 0px 1px 5px 2px #d2cdcd;
    }
</style>
<script>
    function sendMsg(){
        // console.log(event)
        if(event.key == 'Enter' && event.keyCode == 13 || event.mozInputSource == 1){
           let url = '/sendMsg';
            var data = document.querySelector("#msgContent").value 
            document.querySelector("#msgContent").value = ''
            document.querySelector("#msgContent").blur
            fetch(url, {
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": document.querySelector("meta[name='csrf-token']").content,
                },
                method: "POST",
                body: JSON.stringify(data),
            }).then(res => res.json()).then((res) => {
                
                if(res == 'done')
                {
                    data.value = ''
                    data.innerHtml = ''
                    document.querySelector('#msg').style.display='none'
                    document.querySelector('#toast').style.display='block'
                    setInterval(()=>{
                        document.querySelector('#toast').style.display='none'
                    },3000)
                    clearInterval()
                }else {
                    document.querySelector('#toast2').style.display='block'
                    setInterval(()=>{
                        document.querySelector('#toast2').style.display='none'
                    },2000)
                    clearInterval()
                }
                
            })
        }
    }
</script>
