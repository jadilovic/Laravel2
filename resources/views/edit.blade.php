<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Task') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
        
            <form method="POST" action="/task/{{ $task->id }}">

                <div class="form-group">
                    <textarea name="description" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white">{{$task->description }}</textarea>	
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" name="update" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Update task</button>
                </div>
            {{ csrf_field() }}
            </form>
            <br>
            <?php 
                $oldguess = isset($_POST['guess']) ? $_POST['guess'] : ""; 
            ?>
            <p>New Guess Game</p>
            <form method="POST" name="newPost" action="/task/{{ $task->id }}">
                <p><label for="guess">Input Guess</label>
                <input type="text" name="guess" id="guess" size="40" value="<?= htmlentities($oldguess) ?>">
                <input type="submit"></p>
                @csrf
            </form>
            <p>Select you favorite color:</p>
            <input type="color" name="colorpicker" value="#0000ff"><br>
            <p>Date:</p>
            <input type="date" name="datepicker" ><br>
            <p>URL</p>
            <input type="url" name="page"><br>
            <p>Transport</p>
            <input type="flying" name="source"><br>
            <p>Guessing game...</p>
            <form method="POST">
                <p><label for="guess" >Input Guess</label>
                <input type="text" name="guess" id="guess"></p>
                <input type="submit" />
                @csrf
            </form>
            <pre>
                $_GET
                <?php
                    print_r($_GET);
                    if (isset($_GET['guess'])) {
                        echo "Get is set " . $_GET['guess'];
                    }
                ?>
            </pre>
            <p>Radio button</p>
            <form method="POST">
                <p>Prefered time:<br>
                    <input type="radio" name="when" value="am">AM<br>
                    <input type="radio" name="when" value="pm" checked>PM
                </p>
                @csrf
            </form>
            <form method="POST">
                <p><label for="checkbox">Check any or more</label><br>
                <input type="checkbox" name="checking" value="c1" checked>C1<br>
                <input type="checkbox" name="checking" value="c2">C2<br>
                <input type="checkbox" name="checking" value="c3">C3</p>
                @csrf
            </form>
            <p><label for="dow1">Dropdown</label></p>
            <select name="down" id="dow1">
                <option value="0">Seleect option</option>
                <option value="1">First</option>
                <option value="2" selected>Second</option>
                <option value="3">Third</option>
            </select>
            <p><label for="txt">Textarea</label></p>
            <textarea name="you" id="txt" cols="30" rows="10">Hello</textarea><br>
            <p><label for="buttons"></label></p>
            <form method="POST">
                <input type="submit" name="dopost" value="Submit" ><br>
                <input type="button" onclick="location.href='/dashboard'; return false" value="Escape">
                @csrf
            </form>
            <p>{{ json_encode($_POST) }}</p>
            <pre>
                $_POST
                <?php
                    var_dump($_POST)
                ?>
            </pre>
        </div>
    </div>
</div>
</x-app-layout>