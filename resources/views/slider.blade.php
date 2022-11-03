<style>
    .carousel-control-prev{
        margin-top: auto;
        margin-bottom: auto;
        background: #4e4e52;
        border-top-right-radius: 50%;
        border-bottom-left-radius: 50%;
        border-bottom-right-radius: 50%;
        border-top-left-radius: 50%;
        width: 50px;
        height: 50px;
    }
    .carousel-control-next{
        margin-top: auto;
        margin-bottom: auto;
        background: #4e4e52;
        border-top-right-radius: 50%;
        border-bottom-left-radius: 50%;
        border-bottom-right-radius: 50%;
        border-top-left-radius: 50%;
        width: 50px;
        height: 50px;
    }
</style>

<div class="center container" style="margin-top: 100px" >
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="width: 1000px;margin: 0 auto;">
        <ol class="carousel-indicators">
            @for($i=0;$i<count($sliders);$i++)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="active"></li>
            @endfor
        </ol>
        <div class="carousel-inner" style="background: #a1beea">
            <div class="carousel-item active" >
                <a href="{{$sliders[0]->url}}"> <img class="d-block" src="{!! $sliders[0]->thumb !!}"style="margin: 0 auto;width: 100%; height: 100%"  ></a>
            </div>
            @foreach($sliders as $slider)
                @if($slider->id == $sliders[0]->id)
                    @continue
                @endif
                <div class="carousel-item" >
                    <a href="{{$slider->url}}"> <img class="d-block" src="{!! $slider->thumb !!}" style="margin: 0 auto;width: 100%; height: 100%" ></a>
                </div>
            @endforeach
        </div>

        <a class="carousel-control-prev"
           href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon"  aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
