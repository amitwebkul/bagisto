@php
    $menu = \Webkul\Core\Tree::create();

    foreach (config('menu.admin') as $item) {
        $menu->add($item, 'menu');
    }

    $menu->items = core()->sortItems($menu->items);

    $allLocales = core()->getAllLocales()->pluck('name', 'code');
@endphp

<div class="fixed top-[57px] h-full bg-white px-[16px] pt-[8px] max-w-[269px] shadow-[0px_8px_10px_0px_rgba(0,_0,_0,_0.2)] max-lg:hidden">
    <div class="h-[calc(100vh-100px)] overflow-auto journal-scroll">
        <nav class="grid w-[222px]">
            {{-- Navigation Content --}}
            <div class="">
                @foreach ($menu->items as $menuItem)
                    <a href="{{ $menuItem['url'] }}">
                        <div class="accordian-toggle flex gap-[10px] p-[6px] items-center cursor-pointer hover:bg-gray-100 hover:rounded-[8px]">
                            <span class="{{ $menuItem['icon'] }}  text-[24px]"></span>
                            <p class="text-gray-600 font-semibold">
                                @lang($menuItem['name']) 
                            </p>
                        </div>
                    </a>

                    {{-- Sub Navigation Content --}}
                    <div class="grid pb-[7px]">
                        @foreach ($menuItem['children'] as $subMenuItem)
                            <a href="{{ $subMenuItem['url'] }}">
                                <p class=" text-gray-600 px-[40px] py-[4px]">
                                    @lang($subMenuItem['name'])
                                </p>
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </nav>
    </div>

    <div class="bg-white mt-[60px] fixed w-full max-w-[221px] bottom-0">
        <div class="flex gap-[10px] p-[6px] items-center">
            <span class="icon-arrow-right text-[24px]"></span>

            <p class="text-gray-600 font-semibold">
                @lang('admin::app.components.layouts.sidebar.collapse')
            </p>
        </div>
    </div>
</div>