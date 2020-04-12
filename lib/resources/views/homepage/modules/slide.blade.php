 <!-- slider event - top -->
<div class="container hidden-xs">
    <div class="fluid_container">
      <div class="camera_violet_skin" id="camera_wrap_1">

      @foreach($slide as $slide)
        @if($slide->status==1)
        <div data-thumb="{!!url('lib/storage/app/slide/'.$slide->slide_img)!!}" data-src="{!!url('lib/storage/app/slide/'.$slide->slide_img)!!}">
            <div class="camera_caption fadeFromBottom">

                <a href="{{$slide->slide_link}}">{{$slide->slide_name}}</a>
            </div>
        </div>
        @endif
        @endforeach
      </div><!-- #camera_wrap_1 -->
    </div><!-- .fluid_container -->
</div> <!-- /slider event - top -->
