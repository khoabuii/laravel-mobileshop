
<?php
    $data = DB::table('blogs')
    ->limit(3)
    ->orderBy('created_at', 'desc')
    ->get();
  ?>
@foreach($data as $row)
<div class="col-lg-12 no-padding">
  <div class="col-lg-4">
    <a href="#" title=""><img src="{!!url('lib/storage/app/blog/'.$row->blog_img)!!}" alt="" width="95%" height="99%"> </a>
  </div>
  <div class="col-lg-8">
    <h4><a href="{!!url('/blog/'.$row->blog_id.'-'.$row->blog_slug)!!}" title="{!!$row->blog_title!!}">{!!$row->blog_title!!}</a></h4>

    <p><strong>Lúc :</strong>{!!$row->created_at!!} <strong></strong></p>
  </div>
</div>
@endforeach
