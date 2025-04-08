import {Spinner} from 'spin.js';

export default function CitadelSpinner(target = document) {
	const spinner = new Spinner().spin()
	$(target).appendChild(spinner.el);
	return spinner
}