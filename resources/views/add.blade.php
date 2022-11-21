<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Add Task') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <form method="POST" action="/task">
                @include('components.alert')
                <div class="form-group">
                    <div class="mt-4">
                        <x-jet-label for="title" value="{{ __('Title') }}" />
                        <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title" required />
                    </div>
                    <div style="display: flex; flex-direction: column; row-gap: 20px">
                        <input type="checkbox"
                            name="active"
                            value="active"
                            @checked(old('active', $isChecked)) 
                        />
                        @php
                            $isActive = false;
                            $hasError = true;
                        @endphp
                        
                        <span @class([
                            'p-4',
                            'font-bold' => $isActive,
                            'text-gray-500' => ! $isActive,
                            'bg-gray-100' => $hasError,
                        ])>Testing</span>
    
                        <span class="p-4 text-gray-500 bg-red">Test class</span>
                        <select name="version">
                            @foreach ($versions as $version)
                                <option value="{{$version}}" @selected(old('version') == $version)>
                                    {{$version}}
                                </option>
                            @endforeach
                        </select>
                        <textarea name="description" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"  placeholder='Enter your task'></textarea>  
                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                        <a href="{{ URL::route('profile.show'); }}">My Profile</a>
                        <h4>Date: {{ date('Y-m-d', time())}}</h4>

                    </div>
                </div>

                <div class="form-group">
                    <x-jet-button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Task</x-jet-button>
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>
</x-app-layout>
