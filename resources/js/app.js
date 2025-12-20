// import './bootstrap';
import 'flowbite';
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';
// // document.addEventListener('livewire:initialized', () => {
// document.addEventListener('toast', (data) => {
// 	// alert("atencionnnnnnn");
// 	const Toast = Swal.mixin({
// 		toast: true,
// 		position: "top-end",
// 		showConfirmButton: false,
// 		timer: 3000,
// 		timerProgressBar: true,
// 		didOpen: (toast) => {
// 			toast.onmouseenter = Swal.stopTimer;
// 			toast.onmouseleave = Swal.resumeTimer;
// 		}
// 	});
// 	Toast.fire({
// 		icon: data.icon || 'success',
// 		title: data.title || 'Notification',
// 		text: data.message || 'Hola',
// 	});
// });
// });

const notyf = new Notyf({
	duration: 1000,
	position: {
		x: 'right',
		y: 'top',
	},
	types: [
		{
			type: 'warning',
			background: 'orange',
			icon: {
				className: 'material-icons',
				tagName: 'i',
				text: 'warning'
			}
		},
		{
			type: 'error',
			background: '#00FF00',
			duration: 2000,
			dismissible: true
		},
		{
			type: 'success',
			background: '#007b10',
			duration: 2000,
			dismissible: true
		}
	]
});

Livewire.on('notify', () => {
	notyf.success("Probando");

});
