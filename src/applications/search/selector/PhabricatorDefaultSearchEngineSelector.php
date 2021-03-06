<?php

/*
 * Copyright 2012 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * @group search
 */
final class PhabricatorDefaultSearchEngineSelector
  extends PhabricatorSearchEngineSelector {

  public function newEngine() {
    $elastic_host = PhabricatorEnv::getEnvConfig('search.elastic.host');
    if ($elastic_host) {
      return new PhabricatorSearchEngineElastic($elastic_host);
    }
    return new PhabricatorSearchEngineMySQL();
  }
}
