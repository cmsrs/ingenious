# Recruitment Task 🧑‍💻👩‍💻

### Invoice module with approve and reject system as a part of a bigger enterprise system. Approval module exists and you should use it. It is Backend task, no Frontend is needed.
---
Please create your own repository and make it public or invite us to check it.


<table>
<tr>
<td>

- Invoice contains:
  - Invoice number
  - Invoice date
  - Due date
  - Company
    - Name 
    - Street Address
    - City
    - Zip code
    - Phone
  - Billed company
    - Name 
    - Street Address
    - City
    - Zip code
    - Phone
    - Email address
  - Products
    - Name
    - Quantity
    - Unit Price	
    - Total
  - Total price
</td>
<td>
Image just for visualization
<img src="https://templates.invoicehome.com/invoice-template-us-classic-white-750px.png" style="width: auto"; height:100%" />
</td>
</tr>
</table>

### TO DO:
Simple Invoice module which is approving or rejecting single invoice using information from existing approval module which tells if the given resource is approvable / rejectable. Only 3 endpoints are required:
```
  - Show Invoice data, like in the list above
  - Approve Invoice
  - Reject Invoice
```
* In this task you must save only invoices so don’t write repositories for every model/ entity.

* You should be able to approve or reject each invoice just once (if invoice is approved you cannot reject it and vice versa.

* You can assume that product quantity is integer and only currency is USD.

* Proper seeder is located in Invoice module and it’s named DatabaseSeeder

* In .env.example proper connection to database is established.

* Using proper DDD structure is mandatory (with elements like entity, value object, repository, mapper / proxy, DTO).
Unit tests in plus.

* Docker is in docker catalog and you need only do 
  ```
  ./start.sh
  ``` 
  to make everything work

  docker container is in docker folder. To connect with it just:
  ```
  docker compose exec workspace bash
  ``` 

### My solution:

1.
```
php artisan migrate
```

2.
run test
```
./vendor/bin/phpunit ./tests/Feature/Modules/Invoices/Infrastructure/Database/Models/InvoiceTest.php
```

3.
my changes (commit name: My solution):
```
git show  980a08352837198e72b9ca9808cbb5d4890afb23
```

4.
example endpoints:
```
http://localhost:8000/api/show/2b9fbae0-8709-48f3-ad95-d5d29d7839af
```

```
http://localhost:8000/api/reject/2b9fbae0-8709-48f3-ad95-d5d29d7839af
```

```
http://localhost:8000/api/approve/2b9fbae0-8709-48f3-ad95-d5d29d7839af
```

TODO:
- it is not written in DDD
- usage of eloquent models in Controllers (todo RS: use service - easy)
- Controllers are heavy: code is not encapsulated in Service/Command/etc (todo RS: use service - easy)
- Invoice module invokes ApprovalFacade directly instead of usage of adapter pattern (RS: fix, see commit: "fix: Invoice module invokes ApprovalFacade directly instead of usage of adapter pattern")
