# DataFormPro
## Overview
DataFormPro is a PHP-based web application designed for easy data input, processing, and export. Users can input data through a form, which gets saved to a text file. Additionally, the data can be exported to a CSV file for further analysis or record-keeping.

## Features
- **Data Input Form:** Allows users to input their name, address, phone number, and additional notes.
- **Data Storage:** Inputs are stored in a text file (data.txt).
- **CSV Export:** Stored data can be exported to a CSV file (export.csv).
- **Validation:** Ensures phone numbers contain only digits.

## Installation
1. Clone the repository to your local machine:
```bash
git clone https://github.com/zuhi535/DataFormPro.git
```
2. Navigate to the project directory:
```bash
cd DataFormPro
```
3. Place the project in your web server's root directory (e.g., htdocs for XAMPP).
## Usage
1. Start your web server (e.g., XAMPP, WAMP).
2. Open your web browser and navigate to http://localhost/DataFormPro.
3. Fill in the form with the required details:
    - Name
    - Address
    - Phone
    - Note
4. Click Submit to save the data to data.txt.
5. Click Export to CSV to export the data to export.csv.
## Code Explanation
### PHP Functions
- **writeDataToFile($name, $address, $phone, $note):**
Writes the submitted data to a text file (data.txt).

- **exportToCSV():**
Exports the data from data.txt to a CSV file (export.csv).
### HTML Form
The form includes fields for name, address, phone, and a note, and two buttons for submitting the data and exporting it to a CSV file.
### JavaScript
- **validatePhoneNumber(input):**
Validates the phone number input to ensure it contains only digits.
## Example
After filling in and submitting the form, the following data is displayed:
```bash
Name: John Doe
Address: 123 Main St
Phone: 5551234567
Note: This is a test note.
```
The data is stored in data.txt and can be exported to export.csv.
