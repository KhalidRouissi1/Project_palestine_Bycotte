<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Scanner</title>
    <!-- Include QuaggaJS library -->
    <script src="https://cdn.rawgit.com/serratus/quaggaJS/0.12.2/dist/quagga.min.js"></script>
</head>
<body>
    <h1>Barcode Scanner</h1>

    <div id="barcode-scanner"></div>

    <script>
        // Configure QuaggaJS
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#barcode-scanner'),
                constraints: {
                    width: 480,
                    height: 320,
                    facingMode: "environment"
                },
            },
            decoder: {
                readers: ["ean_reader"]
            }
        });

        // Start QuaggaJS
        Quagga.start();

        // Add listener for successful barcode scans
        Quagga.onDetected(function(result) {
            // Extract the country from the barcode
            var country = getCountryFromBarcode(result.codeResult.code);
            
            // Show the country using an alert
            alert('Country: ' + country);
        });

        // Function to extract the country from the barcode
        function getCountryFromBarcode(barcode) {
            // Assuming the first two digits of the barcode represent the country code
            var countryCode = barcode.slice(0, 2);

            // Map the country code to the corresponding country (replace this with your actual logic)
            var countryMapping = {
                '01': 'Country A',
                '02': 'Country B',
                '06': 'Tunisia',
                // Add more mappings as needed
            };

            // Check if the country code is in the mapping
            if (countryMapping.hasOwnProperty(countryCode)) {
                return countryMapping[countryCode];
            } else {
                return 'Unknown Country';
            }
        }
    </script>
</body>
</html>
