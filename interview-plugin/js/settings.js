/* Plugin JS */

(function($) {

fetch('https://jsonplaceholder.typicode.com/users')
  .then(result => result.json())
  .then((output) => {

    var company_info = output;

    //HTML 
    var col = [];

    for (var i = 0; i < company_info.length; i++) {
      for (var key in company_info[i]) {
        if (col.indexOf(key) === -1) {
          col.push(key);
        }
      }
    }
    //TABLE
    var table = document.createElement("table");
    //ROWS
    var tr = table.insertRow(-1);
    //HEADERS
    for (var i = 0; i < col.length; i++) {
      var th = document.createElement("th");
      th.innerHTML = col[i];
      tr.appendChild(th);
    }

    //ADD JSON 
    for (var i = 0; i < company_info.length; i++) {
      tr = table.insertRow(-1);

      for (var j = 0; j < col.length; j++) {
        var tabCell = tr.insertCell(-1);
        if (j !== 4 && j !== 7) {
          tabCell.appendChild(document.createTextNode(company_info[i][col[j]]));
          //ADDRESSES 
        } else if (j == 4) {
          var Street = 'address.street';
          var Suite = 'address.suite';
          var City = 'address.city';
          var Zip = 'address.zipcode';

          function findProp(obj, prop, defval) {
            if (typeof defval == 'undefined') defval = null;
            prop = prop.split('.');
            for (var i = 0; i < prop.length; i++) {
              if (typeof obj[prop[i]] == 'undefined')
                return defval;
              obj = obj[prop[i]];
            }
            return obj;
          }
          tabCell.appendChild(document.createTextNode(" " + findProp(company_info[i], Street) + " " + findProp(company_info[i], Suite) + ", " + findProp(company_info[i], City) + ", " + findProp(company_info[i], Zip)));
          //COMPANY
        } else if (j == 7) {
          var Name = 'company.name';
          var Catchphrase = 'company.catchPhrase';
          var Bs = 'company.bs';

          function findProp(obj, prop, defval) {
            if (typeof defval == 'undefined') defval = null;
            prop = prop.split('.');
            for (var i = 0; i < prop.length; i++) {
              if (typeof obj[prop[i]] == 'undefined')
                return defval;
              obj = obj[prop[i]];
            }
            return obj;
          }
          tabCell.appendChild(document.createTextNode(" " + findProp(company_info[i], Name) + " | " + findProp(company_info[i], Catchphrase) + " | " + findProp(company_info[i], Bs)));
        }
      }
    }
    //RENDER
    var divContainer = document.getElementById("showData");
    divContainer.innerHTML = "";
    divContainer.appendChild(table);
  });
	
})(jQuery);
