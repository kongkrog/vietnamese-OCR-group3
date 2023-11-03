# OCR_Website

OCR_Website is a web application built using the CodeIgniter 4 framework. It provides a user-friendly interface for performing Optical Character Recognition (OCR) on images.

## Features
- Upload images for OCR processing
- Extract text from uploaded images
- Display the extracted text on the web interface
- Supports various image formats (e.g., JPEG, PNG)

## Installation

### Requirements
Make sure your server meets the following requirements:

- PHP version 7.4 or higher with the following extensions:
    - intl
    - mbstring

### Steps
1. Clone the repository to your local environment or server.

2. Copy the `.env` file and rename it to `.env.local`.

3. Open `.env.local` and configure the following settings:
   - Set the `baseURL` to the base URL of your website.
   - Set the database settings according to your environment.
   - Customize any other settings as needed.

4. Ensure that your web server is configured to serve the `public` directory as the document root.

5. Run the following command in the project root directory to install the dependencies:
   ```
   composer install
   ```

6. Run the following command to migrate the database:
   ```
   php spark migrate
   ```

7. Start your web server.

## Usage
1. Open your web browser and navigate to the URL where you installed the OCR_Website.

2. On the home page, click on the "Upload Image" button.

3. Select an image file from your local machine and click the "Upload" button.

4. Wait for the OCR process to complete.

5. Once the OCR process is finished, the extracted text will be displayed on the web interface.

## Customization
You can customize the appearance and functionality of the OCR_Website according to your specific requirements. The main files to modify are:

- **View files**: The user interface files are located in the `/app/Views` directory. You can modify these files to change the layout, styling, and content of the web pages.

- **Controller files**: The controller files are located in the `/app/Controllers` directory. You can modify these files to add or modify the application logic.

- **Routes file**: The routes file is located at `/app/Config/Routes.php`. You can modify this file to define custom routes and URLs for your application.

## Contributing
If you find any bugs or have suggestions for new features, please open an issue on our [GitHub repository](https://github.com/your-ocr-website-repo).

## License
This project is licensed under the [MIT License](LICENSE).

## Acknowledgements
- CodeIgniter 4: [https://codeigniter.com/](https://codeigniter.com/)

