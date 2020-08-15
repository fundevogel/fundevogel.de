// @ts-ignore
import lazySizes from 'lazysizes';

import 'lazysizes/plugins/aspectratio/ls.aspectratio';
import 'lazysizes/plugins/attrchange/ls.attrchange';
import 'lazysizes/plugins/native-loading/ls.native-loading';
import 'lazysizes/plugins/progressive/ls.progressive';
import 'lazysizes/plugins/respimg/ls.respimg';

export default () => {
    lazySizes.cfg.init = false;
    lazySizes.cfg.loadMode = 1;

    lazySizes.init();
};
