# input
Input Template


### Install
```
composer require websovn/input
```

### Method

Tên input
```
->name(string $name)
```

Label & input 2 hàng
```
->horizontal(boolean $horizontal)
```

Alias ->title()
```
->label(string $label)
```

Tiêu đề input
```
->title(string $title)
```

Mô tả cho input
```
->help(string $help)
```

Kích thước input (sm, md, lg)
```
->size(string $size)
```

Prefix input
```
->prepend(string $prepend)
```

Kiểu input (text, file, email, tel, ...)
```
->type(string $type)
```

class input
```
->class(string $class)
```

Placeholder input
```
->placeholder(string $placeholder)
```

Bắt buộc nhập
```
->required(boolean $required)
```

Giá trị của input
```
->value(mixed $value)
```

Suffix của input
```
->append(string $append)
```

Thêm icon cho input
```
->icon(string $iconClass)
```

Kiểu file đc phép chọn (chỉ áp dụng cho kiểu file)
```
->accept(string $fileType)
```

Set Class cho div row
```
->gutters(string $class)
```
hoặc
```
->rowClass(string $class)
```
