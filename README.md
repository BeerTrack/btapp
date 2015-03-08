# btapp
Main repo for web app of #BeerTrack


## Global Functions

### getDateAndStockLevels
**Takes in:**

  * start Date
  * end Date  
  * beerstore beer ID
  * beerstore store ID
  * single package type
  * single package quantity
  * single package volume

**Returns:** Array of arrays containing the timestamp and the inventory level at that timestamp. The array is sorted by date, starting from the furthest date. 


**Example of Calling Function:**

   `getDateAndStockLevels('2015-03-02', '2015-03-08', '3211', '2322', 'Bottle', '12', '341');`

Assign the above to a variable, so that you can access the data afterward. 

**Example of What's Returned:**

    Array
    (
    [0] => Array
        (
            [0] => 2015-03-02 23:47:06
            [1] => 60
        )

    [1] => Array
        (
            [0] => 2015-03-03 23:47:06
            [1] => 50
        )

    [2] => Array
        (
            [0] => 2015-03-04 23:47:40
            [1] => 40
        )

    [3] => Array
        (
            [0] => 2015-03-05 23:47:44
            [1] => 30
        )

    [4] => Array
        (
            [0] => 2015-03-06 23:47:47
            [1] => 30
        )

    [5] => Array
        (
            [0] => 2015-03-07 23:47:50
            [1] => 10
        )
    )

**Example of Accessing Specific Days Inventory:**

Let's say you want to know the stock level on March 2nd of a 12 pack of beer 3211 at beer store 2322.

    $data = getDateAndStockLevels('2015-03-02', '2015-03-03', '3211', '2322', 'Bottle', '12', '341');

    echo 'Stock On March 2nd: ' . $data[0][1];

Output:

    Stock On March 2nd: 60
