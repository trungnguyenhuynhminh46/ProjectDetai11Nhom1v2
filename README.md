
# Xây dựng ứng dụng trên AWS cho phép tạo Database và cung cấp api để thêm, xóa, sửa trên Database

## Các tính năng chính

- Thêm, xóa table DynamoDB
- Tương tác dữ liệu của table trực tiếp trên web
- Tương tác dữ liệu của table thông qua API được cung cấp


## Công nghệ sử dụng 

**Client:** Html, Css3, Bootstrap, JS

**Server:** PHP, AWS Lambda, AWS SQS, AWS EC2

**Database:** DynamoDB


## Thành viên tham gia Project

- Lý Quốc Dũng - 19133015 - 19133015@student.hcmute.edu.vn
- Nguyễn Huỳnh Minh Trung - 19133061 - 19133061@student.hcmute.edu.vn
- Bùi Thị Ngân Tuyền - 19133066 - 19133066@student.hcmute.edu.vn


## Cách Chạy Project ở Local (video hướng dẫn + text hướng dẫn):
### Bước 1: Chuẩn bị môi trường
-Link video hướng dẫn: https://youtu.be/L9aZ38QmrSo
+ Vào LearnLab--> start lab --> Aws Detail -->   AWS CLI --> show  copy bảng credentials
+ vào thư mục C:\Users\tên máy\ .aws\credentials
+ past AWS CLI vừa copy file credentials 
- Tải và cài đặt XAMPP và Git
### Bước 2: Cấu hình lại đồ án
- git clone https://github.com/trungnguyenhuynhminh46/ProjectDetai11Nhom1v2 vào thư mục htdocs của XAMPP 
#### Tạo API bằng SQS
- vào AWS Tạo các SQS và Lamda theo file Lamda.txt
- Chú ý Copy URL các SQS vừa tạo và past vào file lib/tables.php trong thư mục project để thay thế các URL của SQS
![SQS](https://user-images.githubusercontent.com/58035150/170737701-ed18f239-5ed4-4964-8c1c-e14830aeb46f.jpg)
#### Tạo API bằng API Gateway
- Vào AWS tạo các Lamda function theo API.txt
- Làm theo video sau để tạo API cho 2 function vừa tạo 
{Video hướng dẫn tạo API}
![API](https://user-images.githubusercontent.com/58035150/170737733-ee732e99-648c-455d-bba5-a2c48f835dcb.png)

### Bước 3: Chạy
- Mở XAMPP và start Apache
- mở trình duyệt http://localhost:'port-apache'/ProjectDetai11Nhom1

## Cách Deploy project EC2 (video hướng dẫn + text hướng dẫn):
Link video hướng dẫn: https://youtu.be/LqgAbx-NY0w
- Tạo EC2 với hệ điều hành window, mở port http và alltraffic
- Tạo Elastic IP kết nối đến EC2
- Connect EC2 bằng remote Desktop Connection
- Trên window của EC2 vào Window Security --> Firewall & network protection --> Windows Defender Firewall Properties --> tag Public Profile --> Allow Inbound connections --> Apply--> ok
- Dowload XAMPP và GIT
- mở git bash trong thư mục htdocs của XAMPP vừa tải về và git clone https://github.com/trungnguyenhuynhminh46/ProjectDetai11Nhom1.git
- Copy .aws của local máy tính và past vào c/user/Administrator của máy window EC2
- mở XAMPP start apache và mở trình duyệt vào http://<ip máy EC2>/ProjectDetai11Nhom1
=> Deploy thành công
