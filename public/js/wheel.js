const wheelGroup = document.getElementById('wheelGroup');

const numbers = [
    0,1,2,3,4,5,6,7,8,9
];

const colors = [

    "#2563eb",
    "#16a34a",
    "#f59e0b",
    "#dc2626",
    "#7c3aed",

    "#0891b2",
    "#ea580c",
    "#22c55e",
    "#e11d48",
    "#475569"

];

const radius = 230;

const cx = 300;
const cy = 300;

const slice = 360 / numbers.length;

for(let i=0;i<numbers.length;i++){

    const start = (slice*i)-90;
    const end = start+slice;

    const x1 = cx + radius*Math.cos(start*Math.PI/180);
    const y1 = cy + radius*Math.sin(start*Math.PI/180);

    const x2 = cx + radius*Math.cos(end*Math.PI/180);
    const y2 = cy + radius*Math.sin(end*Math.PI/180);

    const largeArc = slice>180 ? 1 : 0;

    const path = document.createElementNS(
        "http://www.w3.org/2000/svg",
        "path"
    );

    path.setAttribute(
        "d",
        `
        M ${cx} ${cy}
        L ${x1} ${y1}
        A ${radius} ${radius} 0 ${largeArc} 1 ${x2} ${y2}
        Z
        `
    );

    path.setAttribute(
        "fill",
        colors[i]
    );

    path.setAttribute(
        "stroke",
        "#ffffff"
    );

    path.setAttribute(
        "stroke-width",
        "2"
    );

    wheelGroup.appendChild(path);

}