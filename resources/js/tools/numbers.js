export default {
    random: (min, max) => Math.floor(Math.random() * (max - min + 1)) + min,
    shuffle: array => {
        //Fisher-Yates shuffle (http://en.wikipedia.org/wiki/Fisher%E2%80%93Yates_shuffle)

        var m = array.length, t, i;

        // While there remain elements to shuffle…
        while (m) {

            // Pick a remaining element…
            i = Math.floor(Math.random() * m--);

            // And swap it with the current element.
            t = array[m];
            array[m] = array[i];
            array[i] = t;
        }

        return array;
    }
}
