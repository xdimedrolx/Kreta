/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

import {Config} from '../config';

export class Profile extends Backbone.Model {
  urlRoot() {
    return  Config.baseUrl + '/profile';
  }

  toString () {
    return this.get('name');
  }
}
