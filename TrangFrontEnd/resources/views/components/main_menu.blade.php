<div class="mainmenu pull-left">
    <ul class="nav navbar-nav collapse navbar-collapse">
        <li><a href="{{route('home')}}" class="active">@lang('lang.home')</a></li>

        @foreach($categoryTranslations as $categoryTranslation)
            <li class="dropdown"><a href="#">
                    {{$categoryTranslation->content}}
                    <i class="fa fa-angle-down"></i></a>
            </li>
        @endforeach
        @foreach($categorysLimit as $categoryParent)
             <?php $categoryParent->name ?>
            @include('components.child_menu',['categoryParent'=>$categoryParent])

        @endforeach

        <li><a href="https://vuongicesmile.blogspot.com/">@lang('lang.blogs')</a></li>
        <li><a href="contact-us.html">@lang('lang.contacts')</a></li>
    </ul>
</div>
