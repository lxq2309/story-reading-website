# Triển khai
- Trang khách: https://story-reading.lxq.id.vn
- Trang quản trị: https://story-reading.lxq.id.vn/admin
## Tài khoản người dùng
- Email: user.test@mail.com
- Password: 12345678
- ## Tài khoản người đăng bài
- Email: poster.test@mail.com
- Password: 12345678
- ## Tài khoản người quản trị
- Email: admin.test@mail.com
- Password: 12345678

# Mô tả dữ liệu

1: Mô tả bảng Articles

| Tên thuộc tính | Kiểu dữ liệu | Mô tả | Ràng buộc |
| --- | --- | --- | --- |
| ArticleID | INT | Mã truyện | Khoá chính |
| UserID | INT | Mã người dùng |     |
| Title | NVARCHAR(255) | Tiêu đề truyện |     |
| Description | NVARCHAR(1000) | Mô tả truyện |     |
| IsCompleted | BIT | Đã hoàn thành ?<br><br>(0-Chưa, 1-Rồi) |     |
| CreatedAt | DATETIME | Ngày tạo |     |
| CoverImage | NVARCHAR(255) | Đường dẫn đến ảnh bìa |     |
| UpdatedAt | DATETIME | Ngày sửa |     |
| ViewCount | INT | Số lượt xem |     |
| IsDeleted | BIT | Đã bị xoá ?<br><br>(0-Chưa xoá, 1-Đã xoá) |     |

2: Mô tả bảng Authors

| Tên thuộc tính | Kiểu dữ liệu | Mô tả | Ràng buộc |
| --- | --- | --- | --- |
| AuthorID | INT | Mã tác giả | Khoá chính |
| Name | NVARCHAR(100) | Tên tác giả |     |
| Avatar | NVARCHAR(255) | Đường dẫn đến ảnh tác giả |     |
| Description | NVARCHAR(1000) | Mô tả về tác giả |     |
| IsDeleted | BIT | Đã bị xoá ?<br><br>(0-Chưa xoá, 1-Đã xoá) |     |

3: Mô tả bảng Genres

| Tên thuộc tính | Kiểu dữ liệu | Mô tả | Ràng buộc |
| --- | --- | --- | --- |
| GenreID | INT | Mã thể loại | Khoá chính |
| Name | NVARCHAR(255) | Tên thể loại |     |
| Description | NVARCHAR(1000) | Mô tả về thể loại |     |
| ViewCount | INT | Số lượt xem thể loại |     |
| IsDeleted | BIT | Đã bị xoá ?<br><br>(0-Chưa xoá, 1-Đã xoá) |     |

4: Mô tả bảng Chapters

| Tên thuộc tính | Kiểu dữ liệu | Mô tả | Ràng buộc |
| --- | --- | --- | --- |
| ChapterID | INT | Mã chương truyện | Khoá chính |
| Title | NVARCHAR(255) | Tên chương truyện |     |
| \[Content\] | NVARCHAR(MAX) | Nội dung của chương |     |
| CreatedAt | DATETIME | Ngày tạo chương |     |
| \[Index\] | INT | Số thứ tự chương |     |
| ViewCount | INT | Số lượt xem |     |
| ArticleID | INT | Mã truyện | Liên kết khoá ngoại đến bảng Articles |
| IsDeleted | BIT | Đã bị xoá ?<br><br>(0-Chưa xoá, 1-Đã xoá) |     |

5: Mô tả bảng Users

| Tên thuộc tính | Kiểu dữ liệu | Mô tả | Ràng buộc |
| --- | --- | --- | --- |
| UserID | INT | Mã người dùng | Khoá chính |
| UserName | VARCHAR(20) | Tên người dùng |     |
| Name | NVARCHAR(100) | Tên đầy đủ |     |
| Email | VARCHAR(100) | Thư điện tử |     |
| PhoneNumber | VARCHAR(20) | Số điện thoại |     |
| Address | NVARCHAR(MAX) | Địa chỉ |     |
| DateOfBirth | DATE | Ngày sinh |     |
| Avatar | NVARCHAR(255) | Đường dẫn đến ảnh đại diện |     |
| Description | NVARCHAR(1000) | Mô tả về bản thân |     |
| CreatedAt | DATETIME | Ngày tạo |     |
| Role | INT | Vai trò<br><br>(0-Người dùng, 1-Quản trị viên) |     |
| Password | VARBINARY(MAX) | Mật khẩu đã được mã hoá |     |
| Gender | BIT | Giới tính<br><br>(0-Nam, 1-Nữ) |     |
| IsDeleted | BIT | Đã bị xoá ?<br><br>(0-Chưa xoá, 1-Đã xoá) |     |

6: Mô tả bảng Articles_Authors

| Tên thuộc tính | Kiểu dữ liệu | Mô tả | Ràng buộc |
| --- | --- | --- | --- |
| ArticleID | INT | Mã truyện | Khoá chính, Liên kết khoá ngoại đến bảng Articles, Authors |
| AuthorID | INT | Mã tác giả |

7: Mô tả bảng Articles_Genres

| Tên thuộc tính | Kiểu dữ liệu | Mô tả | Ràng buộc |
| --- | --- | --- | --- |
| ArticleID | INT | Mã truyện | Khoá chính, Liên kết khoá ngoại đến bảng Articles, Genres |
| GenreID | INT | Mã thể loại |

8: Mô tả bảng Bookmarks

| Tên thuộc tính | Kiểu dữ liệu | Mô tả | Ràng buộc |
| --- | --- | --- | --- |
| BookmarkID | INT | Mã dấu trang | Khoá chính, Liên kết khoá ngoại đến bảng Users, Articles |
| UserID | INT | Mã người dùng |
| ArticleID | INT | Mã truyện |
| Name | NVARCHAR(255) | Tên dấu trang |     |
| Description | NVARCHAR(1000) | Mô tả về dấu trang |     |
| IsPublic | BIT | Có công khai không?<br><br>(0-Không, 1-Có) |     |

9: Mô tả bảng Comments

| Tên thuộc tính | Kiểu dữ liệu | Mô tả | Ràng buộc |
| --- | --- | --- | --- |
| CommentID | INT | Mã bình luận | Khoá chính, Liên kết khoá ngoại đến bảng Users, Articles |
| UserID | INT | Mã người dùng |
| ArticleID | INT | Mã truyện |
| \[Content\] | NVARCHAR(1000) | Nội dung bình luận |     |
| CreatedAt | DATETIME | Thời gian bình luận |     |

10: Mô tả bảng Menus

| Tên thuộc tính | Kiểu dữ liệu | Mô tả | Ràng buộc |
| --- | --- | --- | --- |
| ID | INT | Mã menu danh mục | Khoá chính |
| Name | NVARCHAR(255) | Tên liên kết trên menu |     |
| Description | NVARCHAR(1000) | Mô tả về liên kết |     |
| Link | NVARCHAR(1000) | Đường link liên kết trên menu |     |
