@props([
    'name' => '',
    'content' => 'Type something here...'
])
<div class="max-w-full border rounded-lg shadow p-4">
    <div class="flex gap-2 mb-4">
    <button type="button" onclick="execCmd('bold')" class="px-3 py-1 bg-gray-600 text-white rounded hover:bg-gray-700">Bold</button>
    <button type="button" onclick="execCmd('italic')" class="px-3 py-1 bg-gray-600 text-white rounded hover:bg-gray-700">Italic</button>
    <button type="button" onclick="execCmd('underline')" class="px-3 py-1 bg-gray-600 text-white rounded hover:bg-gray-700">Underline</button>
    <button type="button" onclick="clearEditor()" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Clear</button>
    </div>

    <div id="editor" contenteditable="true"
        wire:ignore
        x-data
        x-on:input="$wire.set('{{ $name }}', $el.innerHTML.trim())"
        class="min-h-[100px] relative p-4 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
        {!!$content!!}
    </div>
</div>

<script>
    function execCmd(command) {
        document.execCommand(command, false, null);
    }

    function clearEditor() {
        document.getElementById('editor').innerHTML = '';
    }

    // Prevent <div> creation on Enter and insert <br> instead
    document.addEventListener("DOMContentLoaded", function () {
        const editor = document.getElementById('editor');

        editor.addEventListener("keypress", function (e) {
            if (e.key === "Enter") {
                e.preventDefault();
                document.execCommand("insertHTML", false, "<br><br>");
            }
        });
    });
</script>