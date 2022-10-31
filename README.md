## Installation

1. Put your firebase private key in the project root directory. (The file name is `firebase.json`)
2. Copy .env.example . Type `cp .env.example .env` in CLI.
3. Edit .env . Modify the database environment parameters: `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`. Modify RabbitMQ environment parameters: `RABBITMQ_HOST`, `RABBITMQ_PORT`, `RABBITMQ_LOGIN`, `RABBITMQ_PASSWORD`.
4. Execute `composer install` to install dependent packages.
5. Execute `php artisan key:generate`.
6. Execute `php artisan migrate` to generate the data table required by the project.
7. Execute `php artisan receive` to start processing queue jobs

## Testing Instructions
1. Open `resources/views/welcome.blade.php` and `public/firebase-messaging-sw.js`, put your firebase config.
2. Execute `php artisan serve`.
3. Open your browser, go to `http://127.0.0.1:8000`.
4. Consent to notification authorization.
<img width="324" alt="截圖 2022-10-31 上午9 24 51" src="https://user-images.githubusercontent.com/3984670/198913207-7ecc6a59-9ec2-4db6-a77a-ad3ceeb0f624.png">

5. Open the `console` and you will see your token. Copy it!
<img width="978" alt="截圖 2022-10-31 上午9 24 08" src="https://user-images.githubusercontent.com/3984670/198913161-df478c25-7c28-4761-bcd3-b70f9536e355.png">

6. Put the copied token to your paylod. (e.g. `{"identifier": "fcm-msg-a1beff5ac", "type": "device", "deviceId": "this_is_my_token", "text": "Notification message"}`).
7. Publish this payload on your RabbitMQ.
<img width="755" alt="截圖 2022-10-31 上午9 21 40" src="https://user-images.githubusercontent.com/3984670/198912944-caceb706-7306-418e-bd02-6239bb4161a3.png">

8. You'll see messages from the CLI, browser pop-up notifications, Database has records, Queue `notification.done` has new messages.
<img width="350" alt="截圖 2022-10-31 上午9 26 37" src="https://user-images.githubusercontent.com/3984670/198913395-b487bc1d-c1ef-4479-9e4b-b3ffc0e0c466.png">


<img width="1376" alt="截圖 2022-10-31 上午9 26 45" src="https://user-images.githubusercontent.com/3984670/198913429-c64621c6-5626-49cd-a4ed-7de62983e981.png">

<img width="1186" alt="截圖 2022-10-31 上午9 27 00" src="https://user-images.githubusercontent.com/3984670/198913438-752243c4-c0e0-4b35-9a13-4c98484ee87f.png">


<img width="728" alt="截圖 2022-10-31 上午9 27 20" src="https://user-images.githubusercontent.com/3984670/198913448-1103f061-72e6-4c11-acd5-d29dbbc04202.png">
