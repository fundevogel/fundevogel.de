// @ts-ignore
import lazySizes from 'lazysizes';

import 'lazysizes/plugins/attrchange/ls.attrchange';
import 'lazysizes/plugins/native-loading/ls.native-loading';
import 'lazysizes/plugins/progressive/ls.progressive';
import 'lazysizes/plugins/respimg/ls.respimg';

lazySizes.cfg.init = false;
lazySizes.cfg.expFactor = 2;
lazySizes.cfg.expand = 1000;
lazySizes.cfg.hFac = 1;

export default () => {
    lazySizes.init();
};
