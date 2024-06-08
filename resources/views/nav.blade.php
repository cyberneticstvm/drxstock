 <!-- sidebar tab menu -->
 <div class="sidebar px-3 py-1">
     <div class="d-flex flex-column h-100">
         <h5 class="sidebar-title mb-4 mt-2">DRX<span> - Administrator</span></h5>
         <!-- Menu: main ul -->
         <ul class="menu-list flex-grow-1">
             <li><a class="m-link {{ in_array(Route::currentRouteName(), ['dashboard']) ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['order', 'order.fetch']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-order" href="#"><i class="fa fa-check-square-o"></i> <span>Order</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-order')
                    ->link(route('order'), 'Fetch Order')->addItemClass('ms-link')
                }}
             </li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['user.register', 'user.create', 'user.edit']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-user" href="#"><i class="fa fa-user"></i> <span>User</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-user')
                    ->link(route('user.register'), 'User Register')->addItemClass('ms-link')
                    ->link(route('user.create'), 'Create User')->addItemClass('ms-link')
                }}

             </li>
             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['category.register', 'category.create']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-category" href="#"><i class="fa fa-bars"></i> <span>Category</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-category')
                    ->link(route('category.register'), 'Category Register')->addItemClass('ms-link')
                    ->link(route('category.create'), 'Create Category')->addItemClass('ms-link')
                }}
             </li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['type.register', 'type.create']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-type" href="#"><i class="fa fa-bookmark"></i> <span>Type</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-type')
                    ->link(route('type.register'), 'Type Register')->addItemClass('ms-link')
                    ->link(route('type.create'), 'Create Type')->addItemClass('ms-link')
                }}
             </li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['material.register', 'material.create']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-material" href="#"><i class="fa fa-crop"></i> <span>Material</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-material')
                    ->link(route('material.register'), 'Material Register')->addItemClass('ms-link')
                    ->link(route('material.create'), 'Create Material')->addItemClass('ms-link')
                }}
             </li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['coating.register', 'coating.create']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-coating" href="#"><i class="fa fa-paint-brush"></i> <span>Coating</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-coating')
                    ->link(route('coating.register'), 'Coating Register')->addItemClass('ms-link')
                    ->link(route('coating.create'), 'Create Coating')->addItemClass('ms-link')
                }}
             </li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['product.register', 'product.create', 'product.track']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-product" href="#"><i class="fa fa-cubes"></i> <span>Product</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-product')
                    ->link(route('product.register'), 'Product Register')->addItemClass('ms-link')
                    ->link(route('product.create'), 'Create Product')->addItemClass('ms-link')
                    ->link(route('dashboard'), 'Track Product')->addItemClass('ms-link')
                }}
             </li>

         </ul>
         <!-- Menu: menu collepce btn -->
         <button type="button" class="btn btn-link text-primary sidebar-mini-btn">
             <span><i class="fa fa-arrow-left"></i></span>
         </button>
     </div>
 </div>