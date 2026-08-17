<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Menu Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Alert --}}
            @if(session('success'))
                <div id="success-alert"
                    style="background:#16a34a;color:white;padding:12px;border-radius:8px;margin-bottom:16px;">
                    {{ session('success') }}
                </div>

                <script>
                    setTimeout(() => {
                        document.getElementById('success-alert')?.remove();
                    }, 3000);
                </script>
            @endif

            {{-- Heading --}}
            <div class="flex justify-between items-center mb-6">

                <h1 class="text-2xl font-bold text-white">
                    Menus
                </h1>

                <a href="{{ route('menus.create') }}"
                    style="background:#2563eb;color:white;padding:10px 16px;border-radius:8px;text-decoration:none;">
                    + Add Menu
                </a>

            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">

                <table class="w-full">

                    <thead class="border-b">

                        <tr>

                            <th class="text-left p-4">
                                Image
                            </th>

                            <th class="text-left p-4">
                                Menu
                            </th>

                            <th class="text-left p-4">
                                Category
                            </th>

                            <th class="text-left p-4">
                                Price
                            </th>

                            <th class="text-left p-4">
                                Status
                            </th>

                            <th class="text-left p-4">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($menus as $menu)

                            <tr
                                class="border-b"
                                style="transition:.2s;"
                                onmouseover="this.style.background='#f8fafc'"
                                onmouseout="this.style.background='white'">

                                <td class="p-4">

                                    @if($menu->image)
                                        <img
                                            src="{{ asset('storage/'.$menu->image) }}"
                                            alt="{{ $menu->name }}"
                                            onclick="showImage(this.src)"
                                            style="
                                                width:90px;
                                                height:90px;
                                                object-fit:cover;
                                                border-radius:12px;
                                                cursor:pointer;
                                                transition:.2s;
                                            ">
                                    @else
                                        No Image
                                    @endif

                                </td>

                                <td class="p-4">

                                    <strong>
                                        {{ $menu->name }}
                                    </strong>

                                    <br>

                                    <small class="text-gray-500">
                                        {{ $menu->description }}
                                    </small>

                                </td>

                                <td class="p-4">
                                    {{ $menu->category->name }}
                                </td>

                                <td class="p-4">
                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                </td>

                                <td class="p-4">

                                    @if($menu->is_active)

                                        <span
                                        style="
                                        background:#dcfce7;
                                        color:#166534;
                                        padding:6px 12px;
                                        border-radius:999px;
                                        font-size:13px;
                                        font-weight:600;
                                        ">
                                            Active
                                        </span>

                                        @else

                                        <span
                                        style="
                                        background:#fee2e2;
                                        color:#991b1b;
                                        padding:6px 12px;
                                        border-radius:999px;
                                        font-size:13px;
                                        font-weight:600;
                                        ">
                                            Inactive
                                        </span>

                                        @endif

                                </td>

                                <td class="p-4">

                                    <a
                                        href="{{ route('menus.edit', $menu->id) }}"
                                        style="background:#f59e0b;color:white;padding:6px 12px;border-radius:6px;text-decoration:none;">
                                        📝 Edit
                                    </a>

                                    <form
                                        action="{{ route('menus.destroy', $menu->id) }}"
                                        method="POST"
                                        style="display:inline;">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Delete this menu?')"
                                            style="background:#dc2626;color:white;padding:6px 12px;border:none;border-radius:6px;">
                                            🗑 Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center p-6 text-gray-500">
                                    🍽

                                    No menu available.

                                    Click "Add Menu" to create your first menu.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

    <div
        id="imageModal"
        style="
        display:none;
        position:fixed;
        left:0;
        top:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,.8);
        justify-content:center;
        align-items:center;
        z-index:9999;
        ">

        <img
        id="modalImage"
        style="
        max-width:80%;
        max-height:80%;
        border-radius:10px;
        ">

    </div>

    <script>

    function showImage(src){

        document.getElementById('modalImage').src=src;

        document.getElementById('imageModal').style.display='flex';

    }

    document.getElementById('imageModal').onclick=function(){

        this.style.display='none';

    }

    </script>
</x-app-layout>