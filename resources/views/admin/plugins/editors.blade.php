@extends('layouts/contentLayoutMaster')

@section('title', __('Editors'))

@section('page-style')

@endsection

@section('content')

    <script type="module">
        const options = {
            value: `
function addNumbers(a: number, b: number) { 
    return a + b; 
} 

var sum: number = addNumbers(10, 15) 

console.log('Sum of the two numbers is: ' +sum); 
            `,
            language: 'typescript',
            theme: 'vs-dark',
        }
        import * as monaco from 'https://cdn.jsdelivr.net/npm/monaco-editor@0.39.0/+esm';
        monaco.editor.create(document.querySelector('.monaco') , options);
    </script>
    <link href="https://cdn.jsdelivr.net/npm/vscode-codicons@0.0.17/dist/codicon.min.css" rel="stylesheet">
    <div class="monaco" style="height: 80vh;" class="col-md-12"></div>

@endsection
