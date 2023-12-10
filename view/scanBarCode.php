<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Country Lookup</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            margin: 50px;
            background-color: #f4f4f4;
        }
        #result {
            margin-top: 20px;
            font-weight: bold;
            color: #333;
        }
        h1 {
            color: #007bff;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        input {
            padding: 10px;
            margin: 10px 0;
            width: 80%;
            max-width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Barcode Country Lookup</h1>
    <label for="barcode">Enter Barcode:</label>
    <input type="text" id="barcode" placeholder="Paste barcode here">
    <button onclick="lookupCountry()">Lookup</button>
    <div id="result" style="background-color:  rgba(255, 99, 71, 0.5);color: red; width:50%;margin:auto; " ></div>

    <script>
        function lookupCountry() {
            var barcode = document.getElementById('barcode').value;
            
            // Perform a lookup here using an API or other methods
            // For simplicity, let's assume a static mapping for demonstration purposes
            var country = getCountryFromBarcode(barcode);

            if (country) {
                document.getElementById('result').innerText = 'Country: ' + country + ' BANNED';
            } else {
                document.getElementById('result').innerText = 'This Country is safe to use that product.';
            }
        }

        function getCountryFromBarcode(barcode) {
            var countryMapping = {
                '001-019': 'United States',
                '020-029': 'United States',
                '030-039': 'United States (drugs)',
                '040-049': 'United States (company)',
                '050-059': 'United States (reserved)',
                '060-099': 'United States',
                '100-139': 'United States',
                '200-299': 'Restricted circulation (geographic)',
                '300-379': 'France and Monaco',
                '380': 'Bulgaria',
                '383': 'Slovenia',
                '385': 'Croatia',
                '387': 'Bosnia and Herzegovina',
                '389': 'Montenegro',
                '390': 'Republic of Kosovo',
                '400-440': 'Germany',
                '450-459': 'Japan',
                '471': 'Taiwan',
                '474': 'Estonia',
                '475': 'Latvia',
                '477': 'Lithuania',
                '479': 'Sri Lanka',
                '480': 'Philippines',
                '481': 'Belarus',
                '482': 'Ukraine',
                '484': 'Moldova',
                '485': 'Armenia',
                '486': 'Georgia',
                '489': 'Hong Kong',
                '490-499': 'Japan',
                '500-509': 'United Kingdom',
                '520-521': 'Greece',
                '529': 'Cyprus',
                '530': 'Albania',
                '531': 'North Macedonia',
                '535': 'Malta',
                '539': 'Ireland',
                '540-549': 'Belgium and Luxembourg',
                '560': 'Portugal',
                '569': 'Iceland',
                '570-579': 'Denmark, Faroe Islands, and Greenland',
                '590': 'Poland',
                '594': 'Romania',
                '599': 'Hungary',
                '609': 'Mauritius',
                '623': 'Managed by GS1 Global Office',
                '640-649': 'Finland',
                '680-681': 'China',
                '690-699': 'China',
                '700-709': 'Norway',
                '729': 'Israel',
                '730-739': 'Sweden',
                '740': 'Guatemala',
                '742': 'Honduras',
                '743': 'Nicaragua',
                '744': 'Costa Rica',
                '745': 'Panama',
                '746': 'Dominican Republic',
                '750': 'Mexico',
                '754-755': 'Canada',
                '759': 'Venezuela',
                '760-769': 'Switzerland and Liechtenstein',
                '770-771': 'Colombia',
                '780': 'Chile',
                '784': 'Paraguay',
                '786': 'Ecuador',
                '789-790': 'Brazil',
                '800-839': 'Italy, San Marino, Vatican City',
                '840-849': 'Spain and Andorra',
                '850': 'Cuba',
                '858': 'Slovakia',
                '859': 'Czech Republic',
                '860': 'Serbia',
                '865': 'Mongolia',
                '867': 'North Korea',
                '870-879': 'Netherlands',
                '880-881': 'South Korea',
                '883': 'Myanmar',
                '885': 'Thailand',
                '888': 'Singapore',
                '890': 'India',
                '893': 'Vietnam',
                '900-919': 'Austria',
                '930-939': 'Australia',
                '940-949': 'New Zealand',
                '950': 'GS1 Global Office',
                '951': 'General Manager Numbers (EPC GID scheme)',
                '952': 'Demonstrations and examples',
                '958': 'Macau',
                '960-961': 'GS1 UK Office',
                '962-969': 'GS1 Global Office',
                '977': 'Serial publications (ISSN)',
                '978-979': 'Bookland (ISBN)',
                '980': 'Refund receipts',
                '981-983': 'GS1 coupon identification',
                '990-999': 'GS1 coupon identification'
            };
            var firstThreeDigits = barcode.substring(0, 3);

            for (var codeRange in countryMapping) {
                var [start, end] = codeRange.split('-');

                start = parseInt(start);
                end = parseInt(end);

                var barcodeInt = parseInt(firstThreeDigits);

                if (barcodeInt >= start && barcodeInt <= end) {
                    return countryMapping[codeRange];
                }
            }

            return null;
        }
    </script>
</body>
</html>
