
import {fromEvent} from 'rxjs';
import {ajax} from 'rxjs/ajax';
import {map, catchError} from 'rxjs/operators';

fromEvent(document.querySelector('#check'), 'click').subscribe(function(){
    observableCheckStatus.subscribe();
});

const observableCheckStatus = ajax.getJSON(makechtec.imageConverter.conversionDispatcherURL)
    .pipe(map((JSONResponse) => {
        console.log(JSONResponse);

        let percentage = JSONResponse.percentage;

        let responseDOMSpace = {
            percentage: document.querySelector('#response .conversion_percentage'),
            per_convert: document.querySelector('#response .conversion_per_convert'),
            success: document.querySelector('#response .conversion_success'),
            errors: document.querySelector('#response .conversion_errors'),
        };

        responseDOMSpace.percentage.innerHTML = JSONResponse.percentage;
        responseDOMSpace.per_convert.innerHTML = JSONResponse.to_convert;
        responseDOMSpace.success.innerHTML = JSONResponse.success;
        responseDOMSpace.errors.innerHTML = JSONResponse.errors;

        if(percentage < 100 ){
            setTimeout( () => {
                observableCheckStatus.subscribe();
            }, 1000);
            
        }
        else{
            console.log('more than 100');
        }
    }),
    catchError((error) => {
        console.log(error);
    }));