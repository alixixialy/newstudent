---
title: 招新系统
language_tabs:
  - shell: Shell
  - http: HTTP
  - javascript: JavaScript
  - ruby: Ruby
  - python: Python
  - php: PHP
  - java: Java
  - go: Go
toc_footers: []
includes: []
search: true
code_clipboard: true
highlight_theme: darkula
headingLevel: 2
generator: "@tarslib/widdershins v4.0.23"

---

# 招新系统

Base URLs:

# Authentication

# Default

## POST 报名表接口

POST /inde.php

> Body 请求参数

```yaml
name: hlx
sex: nv
major: "55"
college: "44"
QQ: "66"
number: "345"
notes: "44"
first_choice: 技术研发部
second_choice: 外宣部
third_choice: 微信推文部

```

### 请求参数

|名称|位置|类型|必选|说明|
|---|---|---|---|---|
|_ijt|query|array[string]| 是 |none|
|_ij_reload|query|string| 是 |none|
|body|body|object| 否 |none|
|» name|body|string| 否 |none|
|» sex|body|string| 否 |none|
|» major|body|string| 否 |none|
|» college|body|string| 否 |none|
|» QQ|body|string| 否 |none|
|» number|body|string| 否 |none|
|» notes|body|string| 否 |none|
|» first_choice|body|string| 否 |none|
|» second_choice|body|string| 否 |none|
|» third_choice|body|string| 否 |none|

> 返回示例

> 成功

```json
{
  "first_choice": "技术研发部",
  "second_choice": "外宣部",
  "third_choice": "微信推文部"
}
```

```json
"{\"error\":\"无效的部门,222\"}{\"first_choice\":\"技术研发部\",\"second_choice\":\"外\",\"third_choice\":\"微信推文部\"}"
```

```json
{
  "error": "缺少必填字段：name,111"
}
```

```json
{
  "first_choice": "技术研发部",
  "second_choice": "",
  "third_choice": ""
}
```

```json
{
  "True": "成功",
  "error": ""
}
```

```json
{
  "True": "",
  "error": "无效的部门: 外部"
}
```

```json
{
  "Ture": "",
  "error": "缺少必填字段：college,111"
}
```

### 返回结果

|状态码|状态码含义|说明|数据模型|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|

### 返回数据结构

# 数据模型

