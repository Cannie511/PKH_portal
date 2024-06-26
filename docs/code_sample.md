# Controller

- Validation

```php
$this->validate($request, [
    'salary_month'    => 'required|date|date_format:Y-m-d'
]);
```

# Service

- Constructor

```php
/**
     * @param Crm0210Service $crm0210Service
     */
    public function __construct(Crm0210Service $crm0210Service)
    {
        $this->crm0210Service = $crm0210Service;
    }
```

- SQL

```php
$sql .= $this->andWhereDateBetween($param, 'fromDate','toDate', 'a.changed_date', $sqlParam );
$sql .= $this->andWhereString($param, 'change_type', 'a.warehouse_change_type', $sqlParam, true);
$sql .= $this->andWhereInt($param, 'branch_id', 'a.branch_id', $sqlParam );

$sql .= " 
    order by
    a.created_at desc
";
```

# View

- Format currency 

```javascript
{{item.to_date | date: 'yyyy-MM-dd'}}
```

- Format currency 

```javascript
{{item.total_amount | currency : '' : 0}}
```