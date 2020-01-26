@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 xl:px-64 mt-12">
        <h2 class="text-2xl font-bold">FAQs</h2>
        <div class="leading-loose text-lg mt-6">
            <div x-data="{ isOpen: false }">
                <button class="w-full font-bold border-b border-gray-400 py-3 flex justify-between items-center" @click="isOpen = !isOpen">
                    <div>Why do I need Alpine JS?</div>
                    <svg x-show="!isOpen" class="fill-current" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M12 22a10 10 0 110-20 10 10 0 010 20zm0-2a8 8 0 100-16 8 8 0 000 16zm1-9h2a1 1 0 010 2h-2v2a1 1 0 01-2 0v-2H9a1 1 0 010-2h2V9a1 1 0 012 0v2z"/></svg>
                    <svg x-show="isOpen" class="fill-current" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M12 22a10 10 0 110-20 10 10 0 010 20zm0-2a8 8 0 100-16 8 8 0 000 16zm4-8a1 1 0 01-1 1H9a1 1 0 010-2h6a1 1 0 011 1z"/></svg>
                </button>
                <div
                    class="text-gray-700 mt-2 transform origin-top"
                    x-show="isOpen"
                    x-transition:enter="transition-all ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-75"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition-all ease-in duration-100"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-75"
                >
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores iure quas laudantium dicta impedit, est id delectus molestiae deleniti enim nobis rem et nihil. Magni consequuntur, suscipit voluptates, dolorem ut deserunt laboriosam repudiandae, alias vero minima delectus iure quasi id earum reiciendis est culpa autem commodi sed nisi hic. Impedit?
                </div>
            </div>
            <div>
                <button class="w-full font-bold border-b border-gray-400 py-3 flex justify-between items-center mt-4">
                    <div>Why am I so awesome?</div>
                    <svg class="fill-current" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M12 22a10 10 0 110-20 10 10 0 010 20zm0-2a8 8 0 100-16 8 8 0 000 16zm1-9h2a1 1 0 010 2h-2v2a1 1 0 01-2 0v-2H9a1 1 0 010-2h2V9a1 1 0 012 0v2z"/></svg>
                    {{-- <svg class="fill-current" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M12 22a10 10 0 110-20 10 10 0 010 20zm0-2a8 8 0 100-16 8 8 0 000 16zm4-8a1 1 0 01-1 1H9a1 1 0 010-2h6a1 1 0 011 1z"/></svg> --}}
                </button>
                <div class="text-gray-700 mt-2">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure vitae dicta aliquid quam voluptas sit atque nostrum modi qui eveniet cumque a, exercitationem, eum deserunt odio repudiandae repellat temporibus ratione saepe magnam neque tempora debitis nobis rem eaque. Vero, repudiandae.
                </div>
            </div>

        </div>
    </div>

    <div class="container mx-auto px-4 xl:px-64 mt-12 mb-12" x-data="{ tab: 'tab1' }">
        <h2 class="text-2xl font-bold">Tabs</h2>
        <ul class="flex border-b mt-6" >
            <li class="-mb-px mr-1">
                <a
                    class="inline-block rounded-t py-2 px-4 font-semibold hover:text-blue-800"
                    :class="{ 'bg-white text-blue-700 border-l border-t border-r' : tab === 'tab1' }"
                    href="#"
                    @click.prevent="tab = 'tab1'"
                >Tab 1</a>
            </li>
            <li class="-mb-px mr-1">
                <a
                    class="inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold"
                    :class="{ 'bg-white text-blue-700 border-l border-t border-r' : tab === 'tab2' }"
                    href="#"
                    @click.prevent="tab = 'tab2'">Tab 2</a
                >
            </li>
            <li class="-mb-px mr-1">
                <a
                    class="inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold"
                    :class="{ 'bg-white text-blue-700 border-l border-t border-r' : tab === 'tab3' }"
                    href="#" @click.prevent="tab = 'tab3'">Tab 3</a
                >
            </li>
        </ul>
        <div class="content bg-white px-4 py-4 border-l border-r border-b pt-4">
            <div x-show="tab === 'tab1'">
                Tab1 content. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt sunt, consectetur eos quod perferendis mollitia consequuntur natus, porro molestiae qui iusto deserunt rerum tempore voluptatum itaque. Ad, nisi esse cum quidem consequuntur ullam obcaecati id facere beatae accusamus. Exercitationem atque consequatur enim accusantium necessitatibus, iure optio omnis minima consequuntur earum ab nihil, ea, rerum dolor maxime! Voluptatibus, dolore. Et tempore consectetur aut possimus beatae atque harum nemo sed nisi suscipit quia esse, obcaecati? Expedita commodi laboriosam esse dolorem debitis fugiat aspernatur, quidem laudantium? Tempore, doloremque autem culpa ad earum veniam odio sed, cupiditate possimus quidem veritatis et ex nisi vitae!
            </div>
            <div x-show="tab === 'tab2'">
                Tab2 content. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt sunt, consectetur eos quod perferendis mollitia consequuntur natus, porro molestiae qui iusto deserunt rerum tempore voluptatum itaque. Ad, nisi esse cum quidem consequuntur ullam obcaecati id facere beatae accusamus. Exercitationem atque consequatur enim accusantium necessitatibus, iure optio omnis minima consequuntur earum ab nihil, ea, rerum dolor maxime! Voluptatibus, dolore. Et tempore consectetur aut possimus beatae atque harum nemo sed nisi suscipit quia esse, obcaecati? Expedita commodi laboriosam esse dolorem debitis fugiat aspernatur, quidem laudantium? Tempore, doloremque autem culpa ad earum veniam odio sed, cupiditate possimus quidem veritatis et ex nisi vitae!
            </div>
            <div x-show="tab === 'tab3'">
                Tab3 content. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt sunt, consectetur eos quod perferendis mollitia consequuntur natus, porro molestiae qui iusto deserunt rerum tempore voluptatum itaque. Ad, nisi esse cum quidem consequuntur ullam obcaecati id facere beatae accusamus. Exercitationem atque consequatur enim accusantium necessitatibus, iure optio omnis minima consequuntur earum ab nihil, ea, rerum dolor maxime! Voluptatibus, dolore. Et tempore consectetur aut possimus beatae atque harum nemo sed nisi suscipit quia esse, obcaecati? Expedita commodi laboriosam esse dolorem debitis fugiat aspernatur, quidem laudantium? Tempore, doloremque autem culpa ad earum veniam odio sed, cupiditate possimus quidem veritatis et ex nisi vitae!
            </div>
        </div>
    </div>
@endsection
