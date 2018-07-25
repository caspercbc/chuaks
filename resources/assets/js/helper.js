export default {
	convertObjToUrlParams,
	determinePages
}

function convertObjToUrlParams(jsonObj) {
    jsonObj = Object.keys(jsonObj).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(jsonObj[k]);
    }).join('&');        

    return jsonObj;
}

function determinePages(currentPage, firstPage, lastPage){
    var maxDeviation = 2;
    var shiftRight;
    var pages = [];

    if( lastPage - firstPage >= 4 ){

	    if( currentPage - maxDeviation - firstPage < 0 ){
	        shiftRight = -(currentPage - maxDeviation - firstPage);
	    } else if( currentPage + maxDeviation - lastPage > 0 ){
	        shiftRight = -(currentPage + maxDeviation - lastPage);
	    } else {
	        shiftRight = 0;
	    }

	    pages = [ currentPage-2+shiftRight, currentPage-1+shiftRight, currentPage+shiftRight, currentPage+1+shiftRight, currentPage+2+shiftRight ];

	} else {

		var totalPages = lastPage - firstPage + 1;

		for(var i=0; i<totalPages; i++){
			pages.push(firstPage+i);
		}
	}

    return pages;
}