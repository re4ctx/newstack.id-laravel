<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Newstack.id') }}
    </h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      @if ($message = Session::get('success'))
      <div class="py-3 px-5 mb-4 bg-green-100 text-green-900 text-sm rounded-md border border-green-200 flex items-center justify-between" role="alert">
        <span>{{ $message }}</span>
        <button class="w-4" type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      @endif


      <div class="inline-block mr-2 mb-5">
        <a href="/createpost">
          <button type="button" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">+ Tambah Berita</button>
        </a>
      </div>



      <div class="grid grid-cols-3 gap-4">
        @foreach ($beritas as $berita)
        <div class="bg-white overflow-hidden border-b-4 border-blue-500">
          <img src="/storage/{{$berita->foto}}" alt="News" class="w-full object-cover h-32 sm:h-48 md:h-64">
          <div class="p-4 md:p-6">
            <p class="text-blue-600 font-semibold text-xs mb-1 leading-none">{{$berita->kategori}}</p>
            <h3 class="font-semibold mb-2 text-xl leading-tight sm:leading-normal">{{$berita->judul}}</h3>
            <form action="{{ route('beritas.destroy',$berita->id) }}" method="POST">
              <div class="text-sm flex items-end">
                <a href="{{ route('beritas.edit', $berita->id) }}">
                  <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                  </div>
                </a>
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                  <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </div>
                </button>
              </div>
          </div>
          </form>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</x-app-layout>