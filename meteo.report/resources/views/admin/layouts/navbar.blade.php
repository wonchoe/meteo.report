
<ul class="nav-left">
    <li><a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i class="ti-menu"></i></a>
    </li>
</ul>
<ul class="nav-right">

    <li class="dropdown"><a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1"
                            data-toggle="dropdown">
            <div class="peer mR-10"><i class="fa fa-user"></i></div>
            <div class="peer"><span class="fsz-sm c-grey-900">{{ Auth::user()->name }}</span></div>
        </a>
        <ul class="dropdown-menu fsz-sm">
            <li>
                <form action="{{ route('logout') }}" method="post" style="padding-left: 10px;">
                    @csrf
                    <a href="javascript:;" onclick="parentNode.submit();" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                        <i class="ti-power-off mR-10"></i> 
                        <span>Logout</span>
                    </a>  
                </form> 


            </li>
        </ul>
    </li> 
</ul>