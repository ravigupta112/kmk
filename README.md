
## Setup

### Step 1 - Clone or Download

```
git clone https://github.com/ravigupta112/kmk.git

```

### Step 2 - Change Config File

Please open config.php file and find this code section.
```PHP
  // Config Database
define('DATABASE', [
    'Port'   => '3306',
    'Host'   => 'localhost',
    'Driver' => 'PDO',
    'Name'   => '',
    'User'   => '',
    'Pass'   => '',
    'Prefix' => ''
]);

// DB_PREFIX
define('DB_PREFIX', '');
```
update it with your database credentials. you can choose a prefix and the prefix is optional.

#### Example
 My config.php file is like this

```PHP
  // Config Database
define('DATABASE', [
    'Port'   => '3306',
    'Host'   => 'localhost',
    'Driver' => 'PDO',
    'Name'   => 'kmk',
    'User'   => 'root',
    'Pass'   => '',
    'Prefix' => ''
]);

// DB_PREFIX
define('DB_PREFIX', '');
```

### Step 3 - Installation 

After your updated config.php file. please open this path in your browser.
```
exampl.com/install 
```


## Usage

Create API to get HCO details with its HCP and HOC specialty list for specific HCO.
```
GET : exampl.com/hco-details/:id
```

Create API to Delete HCP.
```
PUT : exampl.com/delete-hcp/:id
```

Create API to Search HCP for specific HCO using search parameters HCP Name, Specialty, Zip.

Post Params
- hcp_name (string)
- specialty (string)
- hcp_zip (string)
```
POST : exampl.com/search-hcp/:id
```
