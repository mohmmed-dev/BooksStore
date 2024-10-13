
            <a href="{{route('admin')}}" class="flex items-center {{request()->is('admin') ? 'active-nav-link opacity-100' : 'opacity-75'}} text-white py-2 pl-3nav-item">
                <i class="fas fa-fw fa-tachometer-alt mx-3"></i>
                {{__('Dashboard')}}
            </a>
            <a href="{{route('books.index')}}" class=" {{request()->is('admin/books*') ? 'active-nav-link opacity-100' : 'opacity-75'}} flex items-center text-white  hover:opacity-100 py-2 pl-3nav-item">
                <i class="fas fa-book mx-3"></i>
                {{__('Books')}}
            </a>
            <a href="{{route('categories.index')}}" class="{{request()->is('admin/categories*') ? 'active-nav-link opacity-100' : 'opacity-75'}} flex items-center text-white  hover:opacity-100 py-2 pl-3nav-item">
                <i class="fas fa-list mx-3"></i>
                {{__('Categories')}}
            </a>
            <a href="{{route('authors.index')}}" class="{{request()->is('admin/authors*') ? 'active-nav-link opacity-100' : 'opacity-75'}} flex items-center text-white  hover:opacity-100 py-2 pl-3nav-item">
                <i class="fas fa-pen mx-3"></i>
                {{__('Authors')}}

            </a>
            <a href="{{route('publishers.index')}}" class="{{request()->is('admin/publishers*') ? 'active-nav-link opacity-100' : 'opacity-75'}} flex items-center text-white  hover:opacity-100 py-2 pl-3nav-item">
                <i class="fas fa-table mx-3"></i>
                {{__('Publishers')}}
            </a>
            <a href="{{route('users.index')}}" class="{{request()->is('admin/users*') ? 'active-nav-link opacity-100' : 'opacity-75'}} flex items-center text-white  hover:opacity-100 py-2 pl-3 nav-item">
                <i class="fas fa-user mx-3"></i>
                {{__('Users')}}
            </a>
            <a href="{{route('all.product')}}" class="{{request()->is('admin/allproduct*') ? 'active-nav-link opacity-100' : 'opacity-75'}} flex items-center text-white  hover:opacity-100 py-2 pl-3 nav-item">
                <i class="fas fa-shopping-bag mx-3"></i>
                {{__('Purchasing')}}
            </a>

