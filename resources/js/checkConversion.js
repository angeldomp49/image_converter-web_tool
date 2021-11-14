
import {fromEvent} from 'rxjs';
import {ajax} from 'rxjs/ajax';
import {map, catchError} from 'rxjs/operators';

const observableCheckStatus = ajax(makechtec.imageConverter.conversionDispatcherURL)
    .pipe(map((serverResponse) => {
        console.log(serverResponse);
    }),
    catchError((error) => {
        console.log(error);
    }));

const checkStatus = () => {
    observableCheckStatus.subscribe({
        error(err){ console.log('error insede observable: '+ err) },
        complete(){ console.log('complete observable') }
    });
}

fromEvent(document.querySelector('#check'), 'click').subscribe(function(){
    checkStatus();
});