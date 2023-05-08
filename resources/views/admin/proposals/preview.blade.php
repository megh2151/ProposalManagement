<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Preview Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/viewerjs@1.10.0/dist/viewer.min.css">
    <style>
        body {
            margin: 0;
        }
        #document {
            height: 100vh;
        }
    </style>
</head>
<body>
    <div ><iframe src="/web/viewer.html?file=https://www.africau.edu/images/default/sample.pdf" width="100%" height="600" frameborder="0"></iframe>

</div>
    <script src="https://cdn.jsdelivr.net/npm/viewerjs@1.10.0/dist/viewer.min.js"></script>
    <script>}
        var documentPath = '/' + '{{ $path }}';
        var documentType = documentPath.split('.').pop();
        if (['pdf', 'doc', 'docx'].indexOf(documentType) === -1) {
            alert('Unsupported file type: ' + documentType);
        } else {
            var viewer = new Viewer(document.getElementById('document'), {
                url: pdfUrl,
                navbar: {
                    zoomIn: 4,
                    zoomOut: 4,
                    oneToOne: 4,
                    reset: 4,
                    prev: 4,
                    play: 4,
                    next: 4,
                    rotateLeft: 4,
                    rotateRight: 4,
                    flipHorizontal: 4,
                    flipVertical: 4,
                },
            });
        }
    </script>
</body>
</html>
